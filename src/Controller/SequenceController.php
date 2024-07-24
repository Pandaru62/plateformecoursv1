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

    #[Route('/add-sequence', name: 'create_sequence', methods: ['POST'])]
    public function create(Request $request): Response
    {
        $sequence = new Sequence();
        $form = $this->createForm(SequenceFormType::class, $sequence);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newSequence = $form->getData();

            // $imagePath = $form->get('image')->getData();
            // if ($imagePath) {
            //     $newFileName = uniqid() . '.' . $imagePath->guessExtension();

            //     try {
            //         $imagePath->move(
            //             $this->getParameter('kernel.project_dir') . '/public/uploads',
            //             $newFileName
            //         );
            //     } catch(FileException $e) {
            //         return new Response($e->getMessage());
            //     }

            //     $newSequence->setImagePath('/uploads/' . $newFileName);

            // }

            $this->em->persist($newSequence);
            $this->em->flush();

            return $this->redirectToRoute('user_home');
        }

        return $this->render('sequence/addsequence.html.twig', [
            'form' => $form
        ]);
    }

}
