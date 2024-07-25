<?php

namespace App\Controller;

use App\Entity\Document;
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

    #[Route('/newdocument', name: 'create_doc', methods: ['GET', 'POST'])]
        public function create(Request $request): Response
    {
        $document = new Document();
        $form = $this->createForm(DocumentFormType::class, $document);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newDocument = $form->getData();
            $newDocument->setArchived(0);

            $documentPath = $form->get('path')->getData();
            if ($documentPath) {
                $newFileName = uniqid() . '.' .$documentPath->guessExtension();

                try {
                    $documentPath->move(
                        $this->getParameter('kernel.project_dir') . '/public/uploads/documents',
                        $newFileName
                    );
                } catch (FileException $e) {
                    return new Response($e->getMessage());
                }
                
                $newDocument->setPath('/uploads/documents/' . $newFileName);
            }

            $this->em->persist($newDocument);
            $this->em->flush();

            return $this->redirectToRoute('user_home');
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
        $form = $this->createForm(DocumentFormType::class, $document);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Get the uploaded file
            $documentPath = $form->get('path')->getData();
            
            if ($documentPath) {
                // Handle document upload
                $oldPath = $document->getPath();
                
                // Delete old file if it exists
                if ($oldPath && file_exists($this->getParameter('kernel.project_dir') . $oldPath)) {
                    unlink($this->getParameter('kernel.project_dir') . $oldPath);
                }

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

            // Update other document fields
            $document->setType($form->get('type')->getData());
            $document->setTitre($form->get('titre')->getData());
            $document->setDescription($form->get('description')->getData());
            $document->setSeance($form->get('seance')->getData());
            $document->setArchived(0);

            // Save the changes
            $this->em->flush();

            // Add success feedback and redirect
            $this->addFlash('success', 'Document updated successfully.');
            return $this->redirectToRoute('user_home');
        }

        // Render the form view
        return $this->render('document/editdocument.html.twig', [
            'document' => $document,
            'form' => $form->createView(),
        ]);
    }



    
    #[Route('/archivedocument/{documentid}', methods: ['GET'], name: 'archive_document')]
    public function archiveSeance($documentid): Response
    {
        $repository = $this->em->getRepository(Document::class);
        $document = $repository->find($documentid);
 
        $document->setArchived(1);

        $this->em->flush();
        return $this->redirectToRoute('user_home');
    }
    


}
