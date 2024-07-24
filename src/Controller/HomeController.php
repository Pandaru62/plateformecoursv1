<?php

namespace App\Controller;

use App\Entity\Sequence;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this -> em = $em;
    }

    #[Route('/', name: 'app_home')]
    public function indexVisitor(): Response
    {
        $randomInt = random_int(1, 50);

        $repository = $this->em->getRepository(Sequence::class);
        $sequences = $repository->findAll();

        return $this->render('home/visitorhome.html.twig', [
            'randomInt' => $randomInt, 'sequences' => $sequences
        ]);
    }

    #[Route('/home', name: 'user_home')]
    public function indexUser(): Response
    {
        $randomInt = random_int(1, 50);

        $repository = $this->em->getRepository(Sequence::class);
        $sequences = $repository->findAll();

        return $this->render('home/userhome.html.twig', [
            'randomInt' => $randomInt, 'sequences' => $sequences
        ]);
    }

}
