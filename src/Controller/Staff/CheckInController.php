<?php

namespace App\Controller\Staff;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CheckType;
use App\Repository\OptionLunchAndLuggageRepository;
use App\Repository\TicketRepository;
use Symfony\Component\HttpFoundation\Request;

class BoardingRegisterController extends AbstractController
{
    /**
     * @var TicketRepository
     */
    private TicketRepository $ticketRepository;

    /**
     * @var OptionLunchAndLuggageRepository
     */
    private OptionLunchAndLuggageRepository $optionRepository;

    public function __construct(TicketRepository $ticketRepository, OptionLunchAndLuggageRepository $optionRepository)
    {

        $this->optionRepository = $optionRepository;
        $this->ticketRepository = $ticketRepository;
    }
    #[Route('/boarding/checkin', name: 'app_boarding_checkin')]
    /**
     * @param Request $request
     * 
     * @return Response
     */
    public function checkIn(Request $request): Response
    {

        $form = $this->createForm(CheckType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ticketCode = $form->getData('register');

            $isLunch = $form->getData('lunch');
            $isLuggage = $form->getData('luggage');
            $isCheckIn = $form->getData('checkIn');
            $ticket = $this->ticketRepository->find($ticketCode);
            $passenger = $ticket->getPassenger();

            $option = $passenger->getOptionLunchAndLuggage();
            $option->setLunch($isLunch);
            $option->setLuggage($isLuggage);

            $ticket->setRegister(true);

            $this->optionRepository->save($option);
            $this->ticketRepository->save($ticket);

            return $this->render('boarding_register/result.html.twig', [
                'ticket' => $ticket
            ]);
        }

        return $this->render('boarding_register/add.html.twig', [
            'formOfSearchingTicket' => $form->createView(),
        ]);

}
}