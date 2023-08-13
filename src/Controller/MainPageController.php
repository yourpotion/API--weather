<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\CityRepository;
use App\Service\WeatherAPIService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainPageController extends AbstractController
{
    /**
     * @var CityRepository
     */
    private CityRepository $cityRepository;

    /**
     * @var WeatherAPIService
     */
    private WeatherAPIService $weatherAPIService;

    public function __construct(CityRepository $cityRepository, WeatherAPIService $weatherAPIService)
    {
        $this->cityRepository = $cityRepository;
        $this->weatherAPIService = $weatherAPIService;
    }

    #[Route('/', name: 'app_main_page')]
    /**
     * @return Response
     */
    public function index(): Response
    {
        $cities = $this->cityRepository->findAll();

        $weatherOfCities = $this->weatherAPIService->weatherOfCities($cities);

        return $this->render('main_page/index.html.twig', [
            'cities' => $cities,
            'hours' => array(1, 3, 6, 12),
            'weatherOfCities' => $weatherOfCities,
        ]);
    }
}
