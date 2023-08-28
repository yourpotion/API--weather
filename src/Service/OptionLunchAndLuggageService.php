<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Flight;
use App\Entity\OptionLunchAndLuggage;
use App\Entity\Passenger;
use Symfony\Component\Form\FormInterface;

class OptionLunchAndLuggageService
{

    /**
     * @param mixed $formOfOptionData
     * @param Passenger $newPassenger
     * @param Flight $currentFlight
     * 
     * @return OptionLunchAndLuggage
     */
    public function set(mixed $formOfOptionData, Passenger $newPassenger, Flight $currentFlight): OptionLunchAndLuggage
    {

        $optionLunchAndLuggage = new OptionLunchAndLuggage();
        $isLunch = $formOfOptionData['lunch'];
        $isLuggage = $formOfOptionData['luggage'];

        $optionLunchAndLuggage->setLunch($isLunch);
        $optionLunchAndLuggage->setLuggage($isLuggage);

        $optionLunchAndLuggage->setPassenger($newPassenger);
        $optionLunchAndLuggage->setFlight($currentFlight);

        return $optionLunchAndLuggage;
    }
}
