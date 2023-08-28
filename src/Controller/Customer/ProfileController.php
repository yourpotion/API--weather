<?php

namespace App\Controller\Customer;

use App\Repository\PassengerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @var PassengerRepository
     */
    private PassengerRepository $passengerRepository;

    public function __construct(PassengerRepository $passengerRepository)
    {
        $this->passengerRepository = $passengerRepository;
    }
    #[Route('/profile/{passengerId}', name: 'app_profile')]
    /**
     * @param int $passengerId
     * 
     * @return Response
     */
    public function index(int $passengerId): Response
    {
        $passenger = $this->passengerRepository->find($passengerId);

        return $this->render('profile/index.html.twig', [
            'passenger' => $passenger,
        ]);
    }
}
