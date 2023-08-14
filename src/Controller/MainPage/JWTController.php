<?php

declare(strict_types=1);

namespace App\Controller\MainPage;

use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JWTController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        
    }

    #[Route('/jwt/token/{userId}', name: 'app_jwt')]
    /**
     * @param JWTTokenManagerInterface $jwtManager
     * @param int $userId
     * 
     * @return Response
     */
    public function index(JWTTokenManagerInterface $jwtManager, int $userId): Response
    {
        $user = $this->userRepository->find($userId);

        $token = $jwtManager->create($user);

        return $this->render('jwt/index.html.twig', [
            'token' => $this->json(['token' => $token]),
        ]);
    }
}
