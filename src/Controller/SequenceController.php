<?php

namespace App\Controller;

use App\Entity\Sequence;
use App\Entity\Seance;
use App\Form\SequenceFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

class SequenceController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this -> em = $em;
    }

    #[Route('/seq/{seq_id}', name: 'app_sequence', methods: ['GET'])]
    public function showSequence($seq_id): Response
    {

        $seqRepository = $this->em->getRepository(Sequence::class);
        $seanceRepository = $this->em->getRepository(Seance::class);
        $allSequences = $seqRepository->findAll();
        $sequence = $seqRepository->find($seq_id);
        $seances = $seanceRepository->findBy(['sequence' => $seq_id]);

        return $this->render('sequence/index.html.twig', [
            'sequence' => $sequence, 'allSequences' => $allSequences, 'seances' => $seances
        ]);
    }

    #[Route('/add-sequence', name: 'create_sequence', methods: ['POST', 'GET'])]
    public function create(Request $request): Response
    {
        $sequence = new Sequence();
        $form = $this->createForm(SequenceFormType::class, $sequence);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newSequence = $form->getData();
            $newSequence->setArchived(0);


            $this->em->persist($newSequence);
            $this->em->flush();

            return $this->redirectToRoute('user_home');
        }

        return $this->render('sequence/addsequence.html.twig', [
            'form' => $form
        ]);
    }

    
    #[Route('/editsequence/{sequenceid}', methods: ['GET', 'POST'], name: 'edit_sequence')]
    public function editSequence($sequenceid, Request $request): Response
    {
        $repository = $this->em->getRepository(Sequence::class);
        $sequence = $repository->find($sequenceid);
        $form = $this->createForm(SequenceFormType::class, $sequence);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sequence->setNumero($form->get('numero')->getData());
            $sequence->setTitre($form->get('titre')->getData());
            $sequence->setDescription($form->get('description')->getData());
            $sequence->setImage($form->get('image')->getData());
            $sequence->setArchived(0);

            $this->em->flush();
            return $this->redirectToRoute('user_home');
        }

        return $this->render('sequence/edit.html.twig', [
            'sequence' => $sequence,
            'form' => $form->createView(),
        ]);
    }



    
    #[Route('/archivesequence/{sequenceid}', methods: ['GET'], name: 'archive_sequence')]
    public function archiveSequence($sequenceid): Response
    {
        $repository = $this->em->getRepository(Sequence::class);
        $sequence = $repository->find($sequenceid);
 
        $sequence->setArchived(1);

        $this->em->flush();
        return $this->redirectToRoute('user_home');
    }

    #[Route('/unarchive/sequence/{sequenceid}', methods: ['GET'], name: 'unarchive_sequence')]
    public function unarchiveSequence($sequenceid): Response
    {
        $repository = $this->em->getRepository(Sequence::class);
        $sequence = $repository->find($sequenceid);
 
        $sequence->setArchived(0);

        $this->em->flush();
        return $this->redirectToRoute('user_home');
    }
    

}
