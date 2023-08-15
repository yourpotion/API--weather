<?php

namespace App\Entity\Subscribe;

use App\Entity\City;
use App\Entity\User;
use App\Repository\UserCityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserCityRepository::class)]
class UserCity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\ManyToOne(inversedBy: 'yes')]
    private User $user;

    #[ORM\ManyToOne(inversedBy: 'userCities')]
    private City $city;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): static
    {
        $this->city = $city;

        return $this;
    }
}
