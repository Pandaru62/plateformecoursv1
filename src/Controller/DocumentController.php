<?php

namespace App\Controller;

use App\Entity\Document;
use App\Form\DocumentFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

            $this->em->persist($newDocument);
            $this->em->flush();

            return $this->redirectToRoute('user_home');
        }

        return $this->render('document/adddocument.html.twig', [
            'form' => $form
        ]);
    }


    
    #[Route('/editdocument/{documentid}', methods: ['GET', 'POST'], name: 'edit_document')]
    public function editSequence($documentid, Request $request): Response
    {
        $repository = $this->em->getRepository(Document::class);
        $document = $repository->find($documentid);
        $form = $this->createForm(DocumentFormType::class, $document);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $document->setType($form->get('type')->getData());
            $document->setTitre($form->get('titre')->getData());
            $document->setDescription($form->get('description')->getData());
            $document->setSeance($form->get('seance')->getData());
            $document->setType($form->get('path')->getData());
            $document->setArchived(0);

            $this->em->flush();
            return $this->redirectToRoute('user_home');
        }

        return $this->render('document/edit.html.twig', [
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
