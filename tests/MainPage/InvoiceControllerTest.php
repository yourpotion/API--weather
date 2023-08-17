<?php

declare(strict_types=1);

namespace App\tests;

use App\Controller\MainPage\InvoiceController;
use App\Message\AsyncNotificationMessage;
use Symfony\Component\Messenger\MessageBusInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Stamp\BusNameStamp;
use Symfony\Component\Messenger\Stamp\DelayStamp;

class InvoiceControllerTest extends TestCase
{
    /**
     * @return void
     */
    public function testCountingMethodWithOneHour(): void
    {
        $hour = 1;
        $time = (new InvoiceController())->countingTime($hour);
        $this->assertEquals('3600000', $time);
    }
    /**
     * @return void
     */
    public function testCountingMethodWithThreeHours(): void
    {
        $hour = 3;
        $time = (new InvoiceController())->countingTime($hour);
        $this->assertEquals('10800000', $time);
    }
    /**
     * @return void
     */
    public function testCountingMethodWithSixHours(): void
    {
        $hour = 6;
        $time = (new InvoiceController())->countingTime($hour);
        $this->assertEquals('21600000', $time);
    }
    /**
     * @return void
     */
    public function testCountingMethodWithTwelweHours(): void
    {
        $hour = 12;
        $time = (new InvoiceController())->countingTime($hour);
        $this->assertEquals('43200000', $time);
    }

    /**
     * @return void
     */
    public function testSendingEmail(): void
    {
        $testUserId = 1;

        $message = new AsyncNotificationMessage($testUserId, 'Lets check weather');
        // Отправить уведомление получателю с задержкой

        $messageBusInterface = (new MessageBus());

        $envelope = new Envelope($message);
        $newEnvelope = $messageBusInterface->dispatch($envelope);
        $this->assertSame($envelope->getMessage(), $newEnvelope->getMessage());
    }

    /**
     * @return void
     */
    public function testItHasTheRightInterface(): void
    {
        $bus = new MessageBus();

        $this->assertInstanceOf(MessageBusInterface::class, $bus);
    }

    /**
     * @return void
     */
    public function testItAddsTheStampsToEnvelope(): void
    {
        $testUserId = 1;

        $message = new AsyncNotificationMessage($testUserId, 'Lets check weather');
        
        $finalEnvelope = (new MessageBus())->dispatch($message, [new DelayStamp(5), new BusNameStamp('bar')]);
        $this->assertCount(2, $finalEnvelope->all());
    }
}
