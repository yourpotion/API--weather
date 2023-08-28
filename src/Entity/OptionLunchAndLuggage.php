<?php

namespace App\Entity;

use App\Repository\OptionLunchAndLuggageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OptionLunchAndLuggageRepository::class)]
class OptionLunchAndLuggage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column]
    private bool $luggage;

    #[ORM\Column]
    private bool $lunch;

    #[ORM\OneToOne(inversedBy: 'optionLunchAndLuggage', cascade: ['persist', 'remove'])]
    private Passenger $passenger;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private Flight $flight;

    public function getId(): int
    {
        return $this->id;
    }

    public function isLuggage(): bool
    {
        return $this->luggage;
    }

    public function setLuggage(bool $luggage): static
    {
        $this->luggage = $luggage;

        return $this;
    }

    public function isLunch(): bool
    {
        return $this->lunch;
    }

    public function setLunch(bool $lunch): static
    {
        $this->lunch = $lunch;

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

    public function getFlight(): ?Flight
    {
        return $this->flight;
    }

    public function setFlight(?Flight $flight): static
    {
        $this->flight = $flight;

        return $this;
    }
}
