<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Sequence;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ODM\MongoDB\DocumentManager;
use App\Document\LessonKeys;
use App\Document\UserSequenceAccess;

class StudentController extends AbstractController
{


    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this -> em = $em;
    }
    
    #[Route('/studentslist', name: 'student_list', methods: ['GET'])]
    public function showStudentList(): Response
    {

        $userRepo = $this->em->getRepository(User::class);
        $allUsers = $userRepo->findAll();
        

        // Filter out users with ROLE_ADMIN
        $users = array_filter($allUsers, function (User $user) {
            return !in_array('ROLE_ADMIN', $user->getRoles());
        });

        // Sort users by lastname (alphabetically)
        usort($users, function (User $a, User $b) {
        return strcmp($a->getLastname(), $b->getLastname());
    });


        return $this->render('users/studentslist.html.twig', [
            'users' => $users
        ]);
    }
}