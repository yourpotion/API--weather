<?php

declare(strict_types=1);

namespace App\Controller\Customer;

use App\Entity\OptionLunchAndLuggage;
use App\Entity\Passenger;
use App\Form\OptionFormType;
use App\Form\PassengerFormType;
use App\Repository\FlightRepository;
use App\Repository\OptionLunchAndLuggageRepository;
use App\Repository\PassengerRepository;
use App\Service\OptionLunchAndLuggageService;
use App\Service\SetPassengerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ChosenFlightController extends AbstractController
{
    /**
     * @var PassengerRepository
     */
    private PassengerRepository $passengerRepository;

    /**
     * @var FlightRepository
     */
    private FlightRepository $flightRepository;

    /**
     * @var OptionLunchAndLuggageRepository
     */
    private OptionLunchAndLuggageRepository $optionRepository;

    /**
     * @var OptionLunchAndLuggageService
     */
    private OptionLunchAndLuggageService $optionService;

    /**
     * @var SetPassengerService
     */
    private SetPassengerService $passengerService;
    /**
     * @var bool
     */
    public bool $isLuggage;

    /**
     * @var bool
     */
    public bool $isLunch;


    public function __construct(PassengerRepository $passengerRepository, FlightRepository $flightRepository, OptionLunchAndLuggageRepository $optionRepository, SetPassengerService $passengerService, OptionLunchAndLuggageService $optionService)
    {
        $this->passengerRepository = $passengerRepository;
        $this->flightRepository = $flightRepository;
        $this->optionRepository = $optionRepository;
        $this->passengerService = $passengerService;
        $this->optionService = $optionService;
    }

    #[Route('/flight/{flightId}')]
    /**
     * @param int $flightId
     * @param Request $request
     * @param UserPasswordHasherInterface $userPasswordHasher
     * 
     * @return Response
     */
    public function showPassengerForm(int $flightId, Request $request, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $currentFlight = $this->flightRepository->find($flightId);

        $optionLunchAndLuggage = new OptionLunchAndLuggage();
        $formOfOption = $this->createForm(OptionFormType::class);

        $passenger = new Passenger();
        $formOfPassenger = $this->createForm(PassengerFormType::class, $passenger);

        $formOfPassenger->handleRequest($request);
        $formOfOption->handleRequest($request);

        if ($formOfPassenger->isSubmitted() && $formOfPassenger->isValid()) {
            $formOfOptionData = $formOfOption->getData();
            $newPassenger = $formOfPassenger->getData();

            $optionLunchAndLuggage = $this->optionService->set($formOfOptionData, $newPassenger, $currentFlight);
            $newPassenger = $this->passengerService->set($formOfPassenger, $newPassenger, $userPasswordHasher, $optionLunchAndLuggage);

            $this->optionRepository->save($optionLunchAndLuggage);
            $this->passengerRepository->save($newPassenger);


            return $this->render('booking/index.html.twig', [
                'passenger' => $newPassenger,
                'flight' => $currentFlight,
                'formOfPassenger' => $formOfPassenger->createView()
            ]);
        }
        return $this->render('booking/passengerForm.html.twig', [
            'flight' => $currentFlight,
            'formOfPassenger' => $formOfPassenger->createView(),
            'formOfOption' => $formOfOption->createView()
        ]);
    }
}
