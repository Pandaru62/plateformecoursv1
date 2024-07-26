<?php

namespace App\Controller;

use App\Entity\Sequence;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ArchiveController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this -> em = $em;
    }

    #[Route('/archives', name: 'app_archives')]
    public function archives(): Response
    {
        $repository = $this->em->getRepository(Sequence::class);
        $sequencesArchives = $repository->findBy(['isArchived' => 1]);

        return $this->render('archives/seearchives.html.twig', [
            'sequences' => $sequencesArchives
        ]);
    }

}
