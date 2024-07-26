<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_home');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }

    // #[Route('/grant-admin/{id}', name: 'grant_admin_role')]
    // public function grantAdminRole(int $id, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    // {
    //     $user = $userRepository->findOneBy(['id' => $id]);

    //     if (!$user) {
    //         throw $this->createNotFoundException('User not found');
    //     }

    //     // Get the current roles as an array
    //     $currentRoles = $user->getRoles();

    //     // Add the admin role if it's not already present
    //     if (!in_array('ROLE_ADMIN', $currentRoles, true)) {
    //         $currentRoles[] = 'ROLE_ADMIN';
    //     }

    //     // Set the updated roles
    //     $user->setRoles($currentRoles);

    //     // Persist the changes to the database
    //     $entityManager->flush();

    //     return new Response('Admin role granted to user ' . $id);
    // }

}

