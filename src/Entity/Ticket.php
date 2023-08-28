<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TicketRepository::class)]
class Ticket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\ManyToOne(inversedBy: 'Ticket')]
    private Flight $flight;

    #[ORM\ManyToOne(inversedBy: 'Ticket')]
    private Passenger $passenger;

    #[ORM\Column]
    private bool $register;

    #[ORM\Column(nullable: true)]
    private bool $checkIn;





    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFlight(): ?Flight
    {
        return $this->flight;
    }

    public function setFlight(?Flight $flight): static
    {
        $this->flight = $flight;

        return $this;
    }

    public function getPassenger(): ?Passenger
    {
        return $this->passenger;
    }

    public function setPassenger(?Passenger $passenger): static
    {
        $this->passenger = $passenger;

        return $this;
    }

    public function isRegister(): ?bool
    {
        return $this->register;
    }

    public function setRegister(bool $register): static
    {
        $this->register = $register;

        return $this;
    }

    public function isCheckIn(): ?bool
    {
        return $this->checkIn;
    }

    public function setCheckIn(?bool $checkIn): static
    {
        $this->checkIn = $checkIn;

        return $this;
    }



}
