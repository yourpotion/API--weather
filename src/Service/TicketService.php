<?php

namespace App\Service;

use App\Entity\Flight;
use App\Entity\Passenger;
use App\Entity\Ticket;

class TicketService
{

    /**
     * @param Passenger $currentPassenger
     * @param Flight $currentFlight
     * 
     * @return Ticket
     */
    public function set(Passenger $currentPassenger, Flight $currentFlight): Ticket
    {
        $ticket = new Ticket();

        $ticket->setPassenger($currentPassenger);
        $ticket->setFlight($currentFlight);
        $ticket->setRegister(false);

        return $ticket;
    }
}
