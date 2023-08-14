<?php

declare(strict_types=1);

namespace App\Controller\Subscribe;

use App\Service\SubscribeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SubscribeController extends AbstractController
{

    /**
     * @var SubscribeService
     */
    private SubscribeService $subscribeService;

    public function __construct(SubscribeService $subscribeService)
    {
        $this->subscribeService = $subscribeService;
    }

    #[Route('/subscribe/{cityId}/{userId}', methods: ['GET'], name: 'main_with_id')]

    /**
     * @param int $cityId
     * @param int $userId
     * 
     * @return Response
     */
    public function addSubscribe(int $cityId, int $userId): Response
    {
        $currentUser = $this->getUser();
        $statusOfSubscribing = $this->subscribeService->toggleSubscribe($cityId,$userId, $currentUser);

        return $this->redirectToRoute('app_main_page', [
            'statusOfSubscribing' => $statusOfSubscribing
        ]);
    }
}
