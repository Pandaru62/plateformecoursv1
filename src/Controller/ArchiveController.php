<?php

namespace App\Controller;

use App\Entity\Document;
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

    #[Route('/archives/sequences', name: 'seq_archives')]
    public function archivesSeq(): Response
    {
        $repository = $this->em->getRepository(Sequence::class);
        $sequencesArchives = $repository->findBy(['isArchived' => 1]);

        return $this->render('archives/sequences-archives.html.twig', [
            'sequences' => $sequencesArchives
        ]);
    }

    #[Route('/archives/documents', name: 'doc_archives')]
    public function archivesDoc(): Response
    {
        $repository = $this->em->getRepository(Document::class);
        $documentsArchives = $repository->findBy(['isArchived' => 1]);

        return $this->render('archives/documents-archives.html.twig', [
            'documents' => $documentsArchives
        ]);
    }

}
