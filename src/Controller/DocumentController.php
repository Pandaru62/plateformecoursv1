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

            $this->em->persist($newDocument);
            $this->em->flush();

            return $this->redirectToRoute('user_home');
        }

        return $this->render('document/adddocument.html.twig', [
            'form' => $form
        ]);
    }

}
