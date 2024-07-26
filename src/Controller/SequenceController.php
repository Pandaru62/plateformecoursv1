<?php

namespace App\Controller;

use App\Entity\Sequence;
use App\Document\LessonKeys;
use App\Entity\Seance;
use App\Form\SequenceFormType;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

class SequenceController extends AbstractController
{
    private $em;
    private DocumentManager $dm;
    public function __construct(EntityManagerInterface $em, DocumentManager $dm)
    {
        $this -> em = $em;
        $this->dm = $dm;
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
    // Create a new Sequence object
    $sequence = new Sequence();
    
    // Create the form and handle the request
    $form = $this->createForm(SequenceFormType::class, $sequence);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $newSequence = $form->getData();
        $newSequence->setArchived(0);

        // Handle image upload
        $imagePath = $form->get('image')->getData();
        if ($imagePath) {
            $newFileName = uniqid() . '.' . $imagePath->guessExtension();

            try {
                $imagePath->move(
                    $this->getParameter('kernel.project_dir') . '/public/uploads',
                    $newFileName
                );
            } catch (FileException $e) {
                return new Response($e->getMessage());
            }

            $newSequence->setImage('/uploads/' . $newFileName);
        }

        // Persist the Sequence entity to MySQL
        $this->em->persist($newSequence);
        $this->em->flush();

        // Retrieve the password from the form
        $password = $form->get('password')->getData();

        if ($password) {
            // Create a new SequencePassword document
            $sequencePassword = new LessonKeys();
            $sequencePassword->sequenceId = (string) $newSequence->getId(); // Use the ID from the MySQL entity
            $sequencePassword->password = $password;

            // Persist the SequencePassword document to MongoDB
            $this->dm->persist($sequencePassword);
            $this->dm->flush();
        }

        // Redirect to the desired route
        return $this->redirectToRoute('user_home');
    }

    // Render the form view
    return $this->render('sequence/addsequence.html.twig', [
        'form' => $form->createView(),
    ]);
}


    
#[Route('/editsequence/{sequenceid}', methods: ['GET', 'POST'], name: 'edit_sequence')]
public function editSequence($sequenceid, Request $request): Response
{
    $repository = $this->em->getRepository(Sequence::class);
    $sequence = $repository->find($sequenceid);

    // Fetch the existing password from MongoDB
    $sequencePasswordRepository = $this->dm->getRepository(LessonKeys::class);
    $sequencePassword = $sequencePasswordRepository->findOneBy(['sequenceId' => (string)$sequence->getId()]);

    // Get the current password if it exists
    $currentPassword = $sequencePassword ? $sequencePassword->password : '';

    // Create the form
    $form = $this->createForm(SequenceFormType::class, $sequence);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Update sequence entity
        $sequence->setNumero($form->get('numero')->getData());
        $sequence->setTitre($form->get('titre')->getData());
        $sequence->setDescription($form->get('description')->getData());
        $sequence->setArchived(0);

        // Handle image upload
        $imagePath = $form->get('image')->getData();

        if ($imagePath) {
            // Delete old image if exists
            $oldImage = $sequence->getImage();
            if ($oldImage && file_exists($this->getParameter('kernel.project_dir') . $oldImage)) {
                unlink($this->getParameter('kernel.project_dir') . $oldImage);
            }

            // Upload new image
            $newFileName = uniqid() . '.' . $imagePath->guessExtension();

            try {
                $imagePath->move(
                    $this->getParameter('kernel.project_dir') . '/public/uploads',
                    $newFileName
                );
            } catch (FileException $e) {
                return new Response($e->getMessage());
            }

            $sequence->setImage('/uploads/' . $newFileName);
        }

        // Save sequence
        $this->em->flush();

        // Retrieve the password from the form
        $password = $form->get('password')->getData();

        if ($password) {
            // Update or create the SequencePassword document
            if (!$sequencePassword) {
                $sequencePassword = new LessonKeys();
                $sequencePassword->sequenceId = (string)$sequence->getId();
            }

            // Update the password
            $sequencePassword->password = $password;

            // Persist the SequencePassword document to MongoDB
            $this->dm->persist($sequencePassword);
            $this->dm->flush();
        }

        $this->addFlash('success', 'Sequence updated successfully.');
        return $this->redirectToRoute('user_home');
    }

    return $this->render('sequence/editsequence.html.twig', [
        'sequence' => $sequence,
        'form' => $form->createView(),
        'currentPassword' => $currentPassword, // Pass the current password to the template
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
