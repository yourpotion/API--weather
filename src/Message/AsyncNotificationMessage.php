<?php

namespace App\Message;

class AsyncNotificationMessage
{
    private int $userId;
    private string $message;

    public function __construct(int $userId, string $message)
    {
        $this->userId = $userId;
        $this->message = $message;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}