<?php

declare(strict_types=1);

namespace App\Controller\Staff;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\TicketType;
use App\Repository\TicketRepository;
use Symfony\Component\HttpFoundation\Request;

class BoardingRegisterController extends AbstractController
{
    /**
     * @var TicketRepository
     */
    private TicketRepository $ticketRepository;


    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    #[Route('/boarding/register', name: 'app_boarding_register')]
    /**
     * @param Request $request
     * 
     * @return Response
     */
    public function boardingRegister(Request $request): Response
    {
        $form = $this->createForm(TicketType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ticketCode = $form->getData('id');

            $ticket = $this->ticketRepository->find($ticketCode);

            $ticket->setRegister(true);

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
