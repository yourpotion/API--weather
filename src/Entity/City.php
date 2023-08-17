<?php

namespace App\Entity;

use App\Repository\CityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CityRepository::class)]
class City
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\OneToMany(mappedBy: 'city', targetEntity: UserCity::class)]
    private Collection $userCities;

    #[ORM\ManyToOne(inversedBy: 'cities')]
    private ?User $user;

    #[ORM\Column(length: 255, nullable: true)]
    private string $api;

    public function __construct()
    {
        $this->userCities = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, UserCity>
     */
    public function getUserCities(): Collection
    {
        return $this->userCities;
    }

    public function addUserCity(UserCity $userCity): static
    {
        if (!$this->userCities->contains($userCity)) {
            $this->userCities->add($userCity);
            $userCity->setCity($this);
        }

        return $this;
    }

    public function removeUserCity(UserCity $userCity): static
    {
        if ($this->userCities->removeElement($userCity)) {
            // set the owning side to null (unless already changed)
            if ($userCity->getCity() === $this) {
                $userCity->setCity(null);
            }
        }

        return $this;
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

    public function getApi(): ?string
    {
        return $this->api;
    }

    public function setApi(?string $api): static
    {
        $this->api = $api;

        return $this;
    }
}
