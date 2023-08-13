<?php

namespace App\Controller;

use App\Repository\CityRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
        /**
     * @var CityRepository
     */
    private CityRepository $cityRepository;


    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }
    
    #[Route('/api/{cityId}', name: 'app_api')]
    /**
     * @param int $cityId
     * 
     * @return Response
     */
    public function getCityAPI(int $cityId): Response
    {
        $cityAPI = $this->cityRepository->find($cityId)->getApi();

        return $this->render('api/index.html.twig',[
            'cityAPI' => $cityAPI,
        ]);
    }
}