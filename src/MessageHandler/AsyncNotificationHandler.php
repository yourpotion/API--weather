<?php

namespace App\MessageHandler;

use App\Message\AsyncNotificationMessage;
use App\Repository\UserRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Recipient\Recipient;

class AsyncNotificationHandler implements MessageHandlerInterface
{
    /**
     * @var NotifierInterface
     */
    private NotifierInterface  $notifier;

    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * @param NotifierInterface $notifier
     * @param UserRepository $userRepository
     */
    public function __construct(NotifierInterface $notifier, UserRepository $userRepository)
    {
        $this->notifier = $notifier;
        $this->userRepository = $userRepository;
    }

    /**
     * @param AsyncNotificationMessage $message
     * 
     * @return void
     */
    public function __invoke(AsyncNotificationMessage $message): void
    {
        $currentUser = $this->userRepository->find($message->getUserId());
        
        // Создать уведомление с задержкой
        $notification = (new Notification('New Invoice', ['email']))
            ->content('You got a new invoice for 15 EUR.');

        // Получатель уведомления
        $recipient = new Recipient(
            $currentUser->getEmail(),
        );

        // Отправить уведомление с задержкой
        $this->notifier->send($notification, $recipient);
    }
}