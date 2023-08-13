<?php

declare(strict_types=1);

namespace App\Service;

class WeatherAPIService
{
    /**
     * @param mixed $cities
     * 
     * @return array
     */
    public function weatherOfCities($cities): array
    {
        $informationAboutWeather = [];

        $url = ' ';

        foreach ($cities as $key => $city) {

            $url = $city->getApi();

            $nameOfCity = $city->getName();

            $raw = file_get_contents($url);

            $json = json_decode($raw);

            $weather = $json->weather[0]->main;
            $description = $json->weather[0]->description;

            $temp = $json->main->temp;
            $feelLike = $json->main->feels_like;

            //Wind
            $speed = $json->wind->speed;
            $deg = $json->wind->deg;

            $informationAboutWeather[$key] =
                ["$nameOfCity" => "$weather,$description,$temp,$feelLike,$speed,$deg"];
        }
        return ($informationAboutWeather);
    }
}
