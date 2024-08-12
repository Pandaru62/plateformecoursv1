<?php

namespace App\Controller;

use App\Document\LessonKeys;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PasswordController extends AbstractController
{
    private DocumentManager $dm;

    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
    }

    #[Route('/update-password/{id}', name: 'update_password', methods: ['POST'])]
    public function updatePassword(Request $request, string $id): Response
    {
        $newPassword = $request->request->get('password');
        $sequenceId = $request->request->get('sequenceId');
        
        $lessonKeysRepo = $this->dm->getRepository(LessonKeys::class);
        $lessonKey = $lessonKeysRepo->findOneBy(['sequenceId' => $sequenceId]);

        if ($lessonKey) {
            $lessonKey->password = $newPassword;
            $this->dm->flush();
            $this->addFlash('success', 'Mot de passe mis à jour avec succès');
        } else {
            $this->addFlash('error', 'Une erreur s\'est produite.');
        }

        return $this->redirectToRoute('user_home');
    }
}
