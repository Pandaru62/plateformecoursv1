<?php

namespace App\Controller;

use App\Entity\Document;
use App\Entity\Seance;
use App\Form\DocumentFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;


class DocumentController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this -> em = $em;
    }

    #[Route('/newdocument/{seanceid?}', name: 'create_doc', methods: ['GET', 'POST'])]
    public function create(Request $request, $seanceid = null): Response
    {

        if($seanceid !== null) {
            // retrieve seance id
                $seance = $this->em->getRepository(Seance::class)->find($seanceid);
    
                if (!$seance) {
                    throw $this->createNotFoundException('Séance non trouvée');
                }
            } else {
                $seance = $this->em->getRepository(Seance::class)->findOneBy(['sequence' => 1, 'numero' => 1]);
            }

        $document = new Document();
        $document->setSeance($seance);
        $form = $this->createForm(DocumentFormType::class, $document, [
            'include_changedoc' => false,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newDocument = $form->getData();
            $newDocument->setArchived(0);

            // Check if the document type is 'lien' or a file
            if ($newDocument->getType() !== 'lien' && $newDocument->getType() !== 'video') {
                // This block handles file uploads
                $uploadedFile = $form->get('file_path')->getData();

                if ($uploadedFile) {
                    $newFileName = uniqid() . '.' . $uploadedFile->guessExtension();

                    try {
                        $uploadedFile->move(
                            $this->getParameter('kernel.project_dir') . '/public/uploads/documents',
                            $newFileName
                        );
                    } catch (FileException $e) {
                        return new Response($e->getMessage());
                    }

                    // Set the path to the uploaded file
                    $newDocument->setPath('/uploads/documents/' . $newFileName);
                }
            } else {
                // This block handles when the document type is a link
                $documentPath = $form->get('link_path')->getData();

                if (!empty($documentPath)) {
                    $newDocument->setPath($documentPath); // Set the path to the link
                }
            }

            $lastDocumentOrder = $this->em->getRepository(Document::class)->getLastDocumentOrder()->getDocOrder();
            $newDocument->setDocOrder($lastDocumentOrder +1);

            $this->em->persist($newDocument);
            $this->em->flush();

            return $this->redirectToRoute('app_seance', ['seance_id' => $newDocument->getSeance()->getId()]);
        }

        return $this->render('document/adddocument.html.twig', [
            'form' => $form
        ]);
    }

    
    #[Route('/editdocument/{documentid}', methods: ['GET', 'POST'], name: 'edit_document')]
    public function editDocument($documentid, Request $request): Response
    {
        $repository = $this->em->getRepository(Document::class);
        $document = $repository->find($documentid);
        $form = $this->createForm(DocumentFormType::class, $document, [
            'include_changedoc' => true, // Include the 'changedoc' field
        ]);

        $form->handleRequest($request);

        $currentType = $document->getType();
        $currentPath = $document->getPath();

        switch($currentType) {
            case 'pdf':
                $imageType = 'filetype-pdf';
                break;
            case 'image':
                $imageType = 'card-image';
                break;
            case 'lien':
                $imageType = 'link-45deg';
                break;
            case 'video':
                $imageType = 'camera-video';
                break;
            default:
                $imageType = 'patch-question';
        }

        if ($form->isSubmitted() && $form->isValid()) {

            // check user's choice
            if ($form->get('changedoc')->getData() === 'changeDocYes') {

                // Delete old file if it exists
                if ($currentPath && file_exists($this->getParameter('kernel.project_dir') . $currentPath)) {
                    unlink($this->getParameter('kernel.project_dir') . $currentPath);
                }
                
                // check document's type
                $newType = $form->get('type')->getData();
                if($newType === 'lien' || $newType === 'video') {

                    // the document is a link so we update the path to save the link
                    $document->setPath($form->get('link_path')->getData());

                } else {
                    // the document is a new file
                    $documentPath = $form->get('file_path')->getData();
                
                    if ($documentPath) {
                        
                        // Create new file name
                        $newFileName = uniqid() . '.' . $documentPath->guessExtension();

                        try {
                            // Move the file to the upload directory
                            $documentPath->move(
                                $this->getParameter('kernel.project_dir') . '/public/uploads/documents',
                                $newFileName
                            );
                        } catch (FileException $e) {
                            // Add error handling and feedback
                            $this->addFlash('error', 'File upload error: ' . $e->getMessage());
                            return $this->redirectToRoute('edit_document', ['documentid' => $documentid]);
                        }

                        // Update the document's path
                        $document->setPath('/uploads/documents/' . $newFileName);
                    }

                    // We change the new type in both cases
                    $document->setType($newType);

                }

                
            } else {
                // if there is no change we keep the current path and type
                $document->setPath($currentPath);
                $document->setType($currentType);
            }

                // Update other document fields
                $document->setTitre($form->get('titre')->getData());
                $document->setDescription($form->get('description')->getData());
                $document->setSeance($form->get('seance')->getData());
                $document->setArchived(0);
                $document->setDocOrder($document->getDocOrder());

                // Save the changes
                $this->em->flush();

                // Add success feedback and redirect
                $this->addFlash('success', 'Document updated successfully.');
                return $this->redirectToRoute('app_seance', ['seance_id' => $document->getSeance()->getId()]);
            
        }

        // Render the form view
        return $this->render('document/editdocument.html.twig', [
            'document' => $document,
            'form' => $form->createView(),
            'currentPath' => $currentPath,
            'currentType' => $currentType,
            'imageType' => $imageType,
        ]);
    }

    #[Route('/deletedocument/{documentid}', methods: ['GET'], name: 'delete_document')]
    public function deleteDocument($documentid): Response
    {
        $repository = $this->em->getRepository(Document::class);
        $document = $repository->find($documentid);

        if($document->getType() !== 'lien' && $document->getType() !== 'video') {
            $oldPath = $document->getPath();
                
                // Delete old file if it exists
                if ($oldPath && file_exists($this->getParameter('kernel.project_dir') . $oldPath)) {
                    unlink($this->getParameter('kernel.project_dir') . $oldPath);
                }
        }
 
        $this->em->remove($document);
        $this->em->flush();
        return $this->redirectToRoute('doc_archives');
    }

    
    #[Route('/archivedocument/{documentid}', methods: ['GET'], name: 'archive_document')]
    public function archiveDocument($documentid): Response
    {
        $repository = $this->em->getRepository(Document::class);
        $document = $repository->find($documentid);
 
        $document->setArchived(1);

        $this->em->flush();
        return $this->redirectToRoute('app_seance', ['seance_id' => $document->getSeance()->getId()]);
    }
    
    #[Route('/unarchivedocument/{documentid}', methods: ['GET'], name: 'unarchive_document')]
    public function unarchiveDocument($documentid): Response
    {
        $repository = $this->em->getRepository(Document::class);
        $document = $repository->find($documentid);
 
        $document->setArchived(0);

        $this->em->flush();
        return $this->redirectToRoute('doc_archives');
    }


    #[Route('/documentup/{documentid}', methods: ['GET', 'POST'], name: 'document_up')]
    public function documentUp($documentid): Response
    {
        $repository = $this->em->getRepository(Document::class);
        $document = $repository->find($documentid);
        $documentCurrentOrder = $document->getDocOrder();
        $swipedDocument = $repository->findOneBy(['seance' => $document->getSeance()->getId(), 'doc_order' => $documentCurrentOrder -1]);
 
        $document->setDocOrder($documentCurrentOrder - 1);
        $swipedDocument->setDocOrder($documentCurrentOrder);

        $this->em->flush();
        return $this->redirectToRoute('app_seance', ['seance_id' => $document->getSeance()->getId()]);
    }

    #[Route('/documentdown/{documentid}', methods: ['GET', 'POST'], name: 'document_down')]
    public function documentDown($documentid): Response
    {
        $repository = $this->em->getRepository(Document::class);
        $document = $repository->find($documentid);
        $documentCurrentOrder = $document->getDocOrder();
        $swipedDocument = $repository->findOneBy(['seance' => $document->getSeance()->getId(), 'doc_order' => $documentCurrentOrder +1]);
 
        $document->setDocOrder($documentCurrentOrder + 1);
        $swipedDocument->setDocOrder($documentCurrentOrder);

        $this->em->flush();
        return $this->redirectToRoute('app_seance', ['seance_id' => $document->getSeance()->getId()]);
    }


}
