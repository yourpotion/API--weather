<?php

namespace App\Entity;

use App\Repository\PassengerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: PassengerRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Passenger implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\OneToMany(mappedBy: 'passenger', targetEntity: Ticket::class)]
    private Collection $Ticket;

    #[ORM\Column(length: 255)]
    private string $firstName;

    #[ORM\Column(length: 255)]
    private string $lastName;

    #[ORM\Column(length: 180, unique: true)]
    private string $email;

    #[ORM\Column(length: 255, nullable: true)]
    private string $phoneNumber;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private SeatType $seatType;

    #[ORM\OneToOne(mappedBy: 'passenger', cascade: ['persist', 'remove'])]
    private OptionLunchAndLuggage $optionLunchAndLuggage;

    
    public function __construct()
    {
        $this->Ticket = new ArrayCollection();
    }
    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Ticket>
     */
    public function getTicket(): Collection
    {
        return $this->Ticket;
    }

    public function addTicket(Ticket $ticket): static
    {
        if (!$this->Ticket->contains($ticket)) {
            $this->Ticket->add($ticket);
            $ticket->setPassenger($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): static
    {
        if ($this->Ticket->removeElement($ticket)) {
            // set the owning side to null (unless already changed)
            if ($ticket->getPassenger() === $this) {
                $ticket->setPassenger(null);
            }
        }

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getSeatType(): ?SeatType
    {
        return $this->seatType;
    }

    public function setSeatType(?SeatType $seatType): static
    {
        $this->seatType = $seatType;

        return $this;
    }

    public function getOptionLunchAndLuggage(): ?OptionLunchAndLuggage
    {
        return $this->optionLunchAndLuggage;
    }

    public function setOptionLunchAndLuggage(?OptionLunchAndLuggage $optionLunchAndLuggage): static
    {
        // unset the owning side of the relation if necessary
        if ($optionLunchAndLuggage === null && $this->optionLunchAndLuggage !== null) {
            $this->optionLunchAndLuggage->setPassenger(null);
        }

        // set the owning side of the relation if necessary
        if ($optionLunchAndLuggage !== null && $optionLunchAndLuggage->getPassenger() !== $this) {
            $optionLunchAndLuggage->setPassenger($this);
        }

        $this->optionLunchAndLuggage = $optionLunchAndLuggage;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }
}
