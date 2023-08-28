<?php

namespace App\Service;

use App\Entity\OptionLunchAndLuggage;
use App\Entity\Passenger;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class SetPassengerService
{
    /**
     * @param FormInterface $formOfPassenger
     * @param Passenger $newPassenger
     * @param UserPasswordHasherInterface $userPasswordHasher
     * @param OptionLunchAndLuggage $optionLunchAndLuggage
     * 
     * @return Passenger
     */
    public function set(FormInterface $formOfPassenger, Passenger $newPassenger, UserPasswordHasherInterface $userPasswordHasher, OptionLunchAndLuggage $optionLunchAndLuggage): Passenger
    {

        $newPassenger->setPassword(
            $userPasswordHasher->hashPassword(
                $newPassenger,
                $formOfPassenger->get('plainPassword')->getData()
            )
        );

        $newPassenger->setSeatType(null);

        $newPassenger->setOptionLunchAndLuggage($optionLunchAndLuggage);

        return $newPassenger;
    }
}
