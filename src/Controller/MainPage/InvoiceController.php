<?php

declare(strict_types=1);

namespace App\Controller\MainPage;

use App\Message\AsyncNotificationMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DelayStamp;
use Symfony\Component\Routing\Annotation\Route;

class InvoiceController extends AbstractController
{
    #[Route('/invoice/create/{hours}/{userId}/{cityId}', methods: ['GET'])]

    /**
     * @param int $hours
     * @param int $userId
     * @param MessageBusInterface $messageBus
     * @param int $cityId
     * 
     * @return RedirectResponse
     */
    public function create(int $hours, int $userId, MessageBusInterface $messageBus, int $cityId): RedirectResponse
    {

        $time = (new InvoiceController())->countingTime($hours);

        $message = new AsyncNotificationMessage($userId, 'Lets check weather');
        // Отправить уведомление получателю с задержкой

        $messageBus->dispatch($message)->with(new DelayStamp($time));

        return $this->redirectToRoute('main_with_id', [
            'cityId' => $cityId,
            'userId' => $userId
        ]);
    }

    public function countingTime(int $hours)
    {
        return 3600000 * $hours;
    }
}
