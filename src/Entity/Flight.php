<?php

namespace App\Entity;

use App\Repository\FlightRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FlightRepository::class)]
class Flight
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $departure;

    #[ORM\Column(length: 255)]
    private string $arrival;

    #[ORM\OneToMany(mappedBy: 'flight', targetEntity: Ticket::class)]
    private Collection $ticket;

    #[ORM\Column]
    private int $howManyTickets;


    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private \DateTimeInterface $dateOfDeparture;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private \DateTimeInterface $dateOfArrival;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private \DateTimeInterface $timeOfDeparture;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private \DateTimeInterface $timeOfArrival;

    #[ORM\Column(length: 20)]
    private ?string $price = null;

    public function __construct()
    {
        $this->ticket = new ArrayCollection();
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function getDeparture(): string
    {
        return $this->departure;
    }

    public function setDeparture(string $Departure): static
    {
        $this->departure = $Departure;

        return $this;
    }

    public function getArrival(): string
    {
        return $this->arrival;
    }

    public function setArrival(string $arrival): static
    {
        $this->arrival = $arrival;

        return $this;
    }

    public function getDateOfDeparture(): \DateTimeInterface
    {
        return $this->dateOfDeparture;
    }

    public function setDateOfDeparture(\DateTimeInterface $dateOfDeparture): static
    {
        $this->dateOfDeparture = $dateOfDeparture;

        return $this;
    }

    public function getDateOfArrival(): \DateTimeInterface
    {
        return $this->dateOfArrival;
    }

    public function setDateOfArrival(\DateTimeInterface $dateOfArrival): static
    {
        $this->dateOfArrival = $dateOfArrival;

        return $this;
    }

    public function getTimeOfDeparture(): \DateTimeInterface
    {
        return $this->timeOfDeparture;
    }

    public function setTimeOfDeparture(\DateTimeInterface $timeOfDeparture): static
    {
        $this->timeOfDeparture = $timeOfDeparture;

        return $this;
    }

    public function getTimeOfArrival(): \DateTimeInterface
    {
        return $this->timeOfArrival;
    }

    public function setTimeOfArrival(\DateTimeInterface $timeOfArrival): static
    {
        $this->timeOfArrival = $timeOfArrival;

        return $this;
    }

    /**
     * @return Collection<int, Ticket>
     */
    public function getTicket(): Collection
    {
        return $this->ticket;
    }

    public function addTicket(Ticket $ticket): static
    {
        if (!$this->ticket->contains($ticket)) {
            $this->ticket->add($ticket);
            $ticket->setFlight($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): static
    {
        if ($this->ticket->removeElement($ticket)) {
            // set the owning side to null (unless already changed)
            if ($ticket->getFlight() === $this) {
                $ticket->setFlight(null);
            }
        }

        return $this;
    }

    public function getHowManyTickets(): int
    {
        return $this->howManyTickets;
    }

    public function setHowManyTickets(int $howManyTickets): static
    {
        $this->howManyTickets = $howManyTickets;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

}
