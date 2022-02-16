<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'test', methods: ['POST', 'GET'])]
    public function index(ManagerRegistry $managerRegistry, UserPasswordHasherInterface $passwordHasher): Response
    {
        return new Response('Test');
    }

    #[Route('api/more', name: 'api_more', methods: ['GET'])]
    public function more(): Response
    {
        return $this->json([
            '------ ||||| -------',
        ]);
    }
}
