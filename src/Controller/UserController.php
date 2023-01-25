<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Document\User;
use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UserController.php',
        ]);
    }

    #[Route('/test', name: 'test_user', methods: [ 'GET' ] )]
    public function testUser(ManagerRegistry $doctrine)
    {
        $dm = $doctrine->getManager();
        $user = new User();
        $user->setEmail("hello@medium.com");
        $user->setFirstname("Matt");
        $user->setLastname("Matt");
        $user->setPassword(md5("babababa"));
//        $dm = $this->get('doctrine_mongodb')->getManager();

        $dm->persist($user);
        $dm->flush();
        return new JsonResponse(array('Status' => 'OK'));
    }
    
}
