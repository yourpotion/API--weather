<?php

declare(strict_types=1);

namespace App\Controller\Staff;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\OptionFormType;
use App\Form\PassengerForSupervisorType;
use App\Form\TicketType;
use App\Repository\PassengerRepository;
use App\Service\OptionLunchAndLuggageService;
use Symfony\Component\HttpFoundation\Request;

class BoardingRegisterController extends AbstractController
{
    /**
     * @var OptionLunchAndLuggageService
     */
    private OptionLunchAndLuggageService $optionService;
    /**
     * @var PassengerRepository
     */
    private PassengerRepository $passengerRepository;

    public function __construct(PassengerRepository $passengerRepository, OptionLunchAndLuggageService $optionService)
    {
        $this->passengerRepository = $passengerRepository;
        $this->optionService = $optionService;
    }

    #[Route('/boarding/supervisor', name: 'app_boarding_supervisor')]
    /**
     * @param Request $request
     * 
     * @return Response
     */
    public function supervisorOptions(Request $request): Response
    {
        $formOfPassengerId = $this->createForm(TicketType::class);
        $formOfPassenger = $this->createForm(PassengerForSupervisorType::class);
        $formOfOption = $this->createForm(OptionFormType::class);

        $formOfPassengerId->handleRequest($request);
        $formOfPassenger->handleRequest($request);
        $formOfOption->handleRequest($request);

        if ($formOfPassenger->isSubmitted() && $formOfPassenger->isValid()) {
            $passengerData = $formOfPassenger->getData();
            $passengerId = $formOfPassengerId->getData('id');
            $formOfOptionData = $formOfOption->getData();

            $passengerRole = $passengerData['roles'];
            $isLunch = $formOfOptionData['lunch'];
            $isLuggage = $formOfOptionData['luggage'];

            $passenger = $this->passengerRepository->find($passengerId);

            $passenger->setRoles($passengerRole);

            $currentFlight = $passenger->getFlight();

            $optionLunchAndLuggage = $this->optionService->set($formOfOptionData, $passenger, $currentFlight);

            $passenger->setOptionLunchAndLuggage($optionLunchAndLuggage);
            $passenger->setSeatType(null);

            $this->passengerRepository->save($passenger);

            return $this->render('boarding_register/result.html.twig', [
                'ticket' => $passenger
            ]);
        }


        return $this->render('boarding_register/add.html.twig', [
            'formOfPassengerId' => $formOfPassengerId->createView(),
            'formOfSearchingTicket' => $formOfPassenger->createView(),
            'formOfOption' => $formOfOption->createView()
        ]);
    }
}
