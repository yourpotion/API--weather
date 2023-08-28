<?php

namespace App\Controller\Staff;

use App\Entity\Flight;
use App\Form\FlightStaffFormType;
use App\Repository\FlightRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateFlightController extends AbstractController
{
    /**
     * @var FlightRepository
     */
    private FlightRepository $flightRepository;

    public function __construct(FlightRepository $flightRepository)
    {
        $this->flightRepository = $flightRepository;
    }

    #[Route('/create/flight', name: 'app_create_flight')]
    /**
     * @param Request $request
     * 
     * @return Response
     */
    public function index(Request $request): Response
    {
        $flight = new Flight();
        $form = $this->createForm(FlightStaffFormType::class, $flight);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newFlight = $form->getData();
            $this->flightRepository->save($newFlight);

            return $this->redirect('/');
        }


        return $this->render('main_page/index.html.twig', [
            'formOfFlight' => $form->createView()
        ]);
    }
}
