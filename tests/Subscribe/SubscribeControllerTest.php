<?php

declare(strict_types=1);

use App\Controller\Subscribe\SubscribeController;
use App\Service\SubscribeService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;

class SubscribeControllerTest extends TestCase
{
    /**
     * @return void
     */
    public function testAddSubscribe(): void
    {
        // Create a mock SubscribeService
        $subscribeService = $this->createMock(SubscribeService::class);

        // Configure the behavior of the mock SubscribeService
        $subscribeService->expects($this->once())
            ->method('toggleSubscribe')
            ->with(
                $this->equalTo(123), // cityId
                $this->equalTo(456), // userId
                $this->isInstanceOf(UserInterface::class) // currentUser
            )
            ->willReturn(true); // Assuming a successful subscription toggling

        // Create the SubscribeController instance with the mock SubscribeService
        $controller = new SubscribeController($subscribeService);

        // Mock the getUser() method on the controller
        $user = $this->createMock(UserInterface::class);
        $controller->method('getUser')->willReturn($user);

        // Create a mock Response to simulate the redirect
        $response = $this->createMock(Response::class);

        // Stub the redirectToRoute() method to return the mock Response
        $controller->method('redirectToRoute')->willReturn($response);

        // Call the addSubscribe method
        $result = $controller->addSubscribe(123, 456);

        // Assert that the result is the same as the mock Response
        $this->assertSame($response, $result);
    }
}
