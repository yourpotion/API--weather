<?php

namespace App\Entity;

use App\Repository\SeatTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeatTypeRepository::class)]
class SeatType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
