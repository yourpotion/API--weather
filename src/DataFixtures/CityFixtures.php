<?php

namespace App\DataFixtures;

use App\Repository\CityRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CityFixtures extends Fixture
{
    private CityRepository $cityRepository;

    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }
    /**
     * @param ObjectManager $manager
     * 
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $cityLondon = $this->cityRepository->find(1);
        $cityLondon->setApi('https://api.openweathermap.org/data/2.5/weather?lat=51.50&lon=-0.126&appid=e4f3ad9227c594b69d9b5a071aaf1c56');
        $manager->persist($cityLondon);

        $cityCanada = $this->cityRepository->find(2);
        $cityCanada->setApi('https://api.openweathermap.org/data/2.5/weather?lat=60.109&lon=-113.643&appid=e4f3ad9227c594b69d9b5a071aaf1c56');
        $manager->persist($cityCanada);

        $cityTbilisi = $this->cityRepository->find(3);
        $cityTbilisi->setApi('https://api.openweathermap.org/data/2.5/weather?lat=41.694&lon=-44.834&appid=e4f3ad9227c594b69d9b5a071aaf1c56');
        $manager->persist($cityTbilisi);

        $cityWashington = $this->cityRepository->find(4);
        $cityWashington->setApi('https://api.openweathermap.org/data/2.5/weather?lat=38.895&lon=-77.036&appid=e4f3ad9227c594b69d9b5a071aaf1c56');
        $manager->persist($cityWashington);

        $manager->flush();
    }
}
