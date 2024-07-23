<?php

namespace App\Controller;

use App\Entity\Document;
use App\Entity\Sequence;
use App\Entity\Seance;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

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
}
