<?php

namespace App\Controller;

use App\Entity\Document;
use App\Entity\Sequence;
use App\Entity\Seance;
use App\Form\SeanceFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;


class SeanceController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this -> em = $em;
    }

    #[Route('/seance/{seance_id}', name: 'app_seance', methods: ['GET'])]
    public function showSeance($seance_id): Response
    {

        $seanceRepository = $this->em->getRepository(Seance::class);
        $docRepository = $this->em->getRepository(Document::class);
        $docs = $docRepository->findBy(['seance' => $seance_id]);
        $seance = $seanceRepository->find($seance_id);
        $allSeances = $seanceRepository->findBy(['sequence' => $seance->getSequence()]);
        $sequence = $seance->getSequence();

        // check doc type and assign icon
        foreach($docs as $doc) {
            switch($doc->getType()) {
                case 'pdf':
                    $doc->setType('filetype-pdf');
                    break;
                case 'image':
                    $doc->setType('card-image');
                    break;
                case 'link':
                    $doc->setType('link-45deg');
                    break;
                case 'video':
                    $doc->setType('camera-video');
                    break;
                default:
                    $doc->setType('patch-question');
            }
        }

        return $this->render('seance/index.html.twig', [
            'seance' => $seance, 'docs' => $docs, 'sequence' => $sequence, 'allSeances' => $allSeances
        ]);
    }

    #[Route('/add-seance', name: 'create_seance', methods: ['POST', 'GET'])]
    public function create(Request $request): Response
    {
        $seance = new Seance();
        $form = $this->createForm(SeanceFormType::class, $seance);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newSeance = $form->getData();
            $newSeance->setArchived(0);

            $this->em->persist($newSeance);
            $this->em->flush();

            return $this->redirectToRoute('user_home');
        }

        return $this->render('seance/addseance.html.twig', [
            'form' => $form
        ]);
    }

    
    #[Route('/editseance/{seanceid}', methods: ['GET', 'POST'], name: 'edit_seance')]
    public function editSequence($seanceid, Request $request): Response
    {
        $repository = $this->em->getRepository(Seance::class);
        $seance = $repository->find($seanceid);
        $form = $this->createForm(SeanceFormType::class, $seance);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $seance->setNumero($form->get('numero')->getData());
            $seance->setTitre($form->get('titre')->getData());
            $seance->setDescription($form->get('description')->getData());
            $seance->setSequence($form->get('sequence')->getData());
            $seance->setArchived(0);

            $this->em->flush();
            return $this->redirectToRoute('user_home');
        }

        return $this->render('seance/edit.html.twig', [
            'seance' => $seance,
            'form' => $form->createView(),
        ]);
    }



    
    #[Route('/archiveseance/{seanceid}', methods: ['GET'], name: 'archive_seance')]
    public function archiveSeance($seanceid): Response
    {
        $repository = $this->em->getRepository(Seance::class);
        $seance = $repository->find($seanceid);
 
        $seance->setArchived(1);

        $this->em->flush();
        return $this->redirectToRoute('user_home');
    }
    

}