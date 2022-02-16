<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Uid\Uuid;

class ApiLoginController extends AbstractController
{
    #[Route('/api/login', name: 'api_login', methods: ['POST'])]
    public function index(): Response
    {
//        if (null === $user) {
//            return $this->json([
//                'message' => 'Missing credentials',
//            ], Response::HTTP_UNAUTHORIZED);
//        }

        $token = Uuid::v4();

        return $this->json([
//            'user' => $user->getUserIdentifier(),
            'token' => $token,
        ]);
    }
}
