<?php

namespace App\Controller\Subscribe;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SubscribingListController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    #[Route('/list/{userId}', name: 'app_subscribing_list')]
    /**
     * @param int $userId
     * 
     * @return Response
     */
    public function index(int $userId): Response
    {
        $user = $this->userRepository->find($userId);


        return $this->render('subscribing_list/index.html.twig', [
            'subscribings' => $user->getCities(),
        ]);
    }
}
