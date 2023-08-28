<?php

declare(strict_types=1);

namespace App\Controller\Customer;

use App\Entity\Flight;
use App\Form\FlightCustomerFormType;
use App\Repository\FlightRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainPageController extends AbstractController
{
    /**
     * @var FlightRepository
     */
    private FlightRepository $flightRepository;

    public function __construct(FlightRepository $flightRepository)
    {
        $this->flightRepository = $flightRepository;
    }

    #[Route('/', name: 'app_main_page')]
    /**
     * @param Request $request
     * 
     * @return Response
     */
    public function index(Request $request): Response
    {
        $flight = new Flight();
        $formOfFlight = $this->createForm(FlightCustomerFormType::class, $flight);

        $formOfFlight->handleRequest($request);

        if ($formOfFlight->isSubmitted() && $formOfFlight->isValid()) {
            $newFlight = $formOfFlight->getData();

            $currentFlights = $this->flightRepository->findBy(
                array(
                    'departure' => $newFlight->getDeparture(),
                    'arrival' => $newFlight->getArrival(),
                    'dateOfDeparture' => $newFlight->getDateOfDeparture()
                )
            );

            if ($currentFlights) {
                return $this->render('main_page/flights.html.twig', [
                    'flights' => $currentFlights,
                ]);
            }
        }

        return $this->render('main_page/index.html.twig', [
            'formOfFlight' => $formOfFlight->createView(),
        ]);
    }


    
}
