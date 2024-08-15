<?php

namespace App\Controller;

use App\Entity\Sequence;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


use Doctrine\ODM\MongoDB\DocumentManager;
use App\Document\LessonKeys;
use App\Document\UserSequenceAccess;
use PhpParser\Comment\Doc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

class HomeController extends AbstractController
{
    private $em;
    private DocumentManager $dm;
    public function __construct(EntityManagerInterface $em, DocumentManager $dm)
    {
        $this-> em = $em;
        $this->dm = $dm;
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

    #[Route('/home', name: 'user_home', methods: ['GET'])]
    public function indexUser(UserInterface $user): Response
    {

        $userSequenceAccessRepository = $this->dm->getRepository(UserSequenceAccess::class);
        $accessRecord = $userSequenceAccessRepository->findBy(['userId' => $user->getUserIdentifier()]);

        $repository = $this->em->getRepository(Sequence::class);
        $sequences = $repository->findBy(['isArchived' => 0]);

        usort($sequences, function (Sequence $a, Sequence $b) {
            return strcmp($a->getNumero(), $b->getNumero());
        });

                // test MongoDB

                $lessonKeysRepo = $this->dm->getRepository(LessonKeys::class);
                $queryBuilder = $lessonKeysRepo->createQueryBuilder();
                $lessonKeys = $lessonKeysRepo->findAll();
        
                // fin test MongoDB

        return $this->render('home/userhome.html.twig', [
            'sequences' => $sequences, 'lessonKeys' => $lessonKeys, 'accessRecord' => $accessRecord
        ]);
    }

    

}
