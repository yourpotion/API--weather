<?php

declare(strict_types=1);

namespace App\Controller\MainPage;

use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class JWTController extends AbstractController
{
    #[Route('/jwt/token/{userId}', name: 'app_jwt')]
    /**
     * @param JWTTokenManagerInterface $jwtManager
     * @param int $userId
     * 
     * @return Response
     */
    public function index(JWTTokenManagerInterface $jwtManager, UserInterface $user): Response
    {
        $token = $jwtManager->create($user);

        return $this->render('jwt/index.html.twig', [
            'token' => $this->json(['token' => $token]),
        ]);
    }
}
