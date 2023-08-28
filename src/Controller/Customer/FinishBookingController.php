<?php

declare(strict_types=1);

namespace App\Controller\Customer;

use App\Repository\FlightRepository;
use App\Repository\PassengerRepository;
use App\Repository\TicketRepository;
use App\Service\TicketService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FinishBookingController extends AbstractController
{
    /**
     * @var FlightRepository
     */
    private FlightRepository $flightRepository;

    /**
     * @var PassengerRepository
     */
    private PassengerRepository $passengerRepository;

    /**
     * @var TicketRepository
     */
    private TicketRepository $ticketRepository;

    /**
     * @var TicketService
     */
    private TicketService $ticketService;

    public function __construct(FlightRepository $flightRepository, PassengerRepository $passengerRepository, TicketRepository $ticketRepository, TicketService $ticketService)
    {
        $this->flightRepository = $flightRepository;
        $this->passengerRepository = $passengerRepository;
        $this->ticketRepository = $ticketRepository;
        $this->ticketService = $ticketService;
    }

    #[Route('/booking/{flightId}/{passengerId}')]
    /**
     * @param int $flightId
     * @param int $passengerId
     * 
     * @return Response
     */
    public function showFlight(int $flightId, int $passengerId): Response
    {

        $currentPassenger = $this->passengerRepository->find($passengerId);
        $currentFlight = $this->flightRepository->find($flightId);

        $ticket = $this->ticketService->set($currentPassenger, $currentFlight);

        $this->ticketRepository->save($ticket);

        $currentPassenger->addTicket($ticket);
        $currentFlight->addTicket($ticket);

        $this->passengerRepository->save($currentPassenger);
        $this->flightRepository->save($currentFlight);

        return $this->render('booking/finish.html.twig', [
            'passenger' => $currentPassenger,
            'flight' => $currentFlight,
            'ticket' => $ticket
        ]);
    }
}
