<?php

declare(strict_types=1);

use App\Controller\Subscribe\SubscribingListController;
use App\Repository\UserRepository;
use App\Entity\User;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SubscribingListControllerTest extends KernelTestCase
{

    /**
     * @return UserRepository
     */
    private function createMockUserRepository(): UserRepository
    {
        $userRepository = $this->createMock(UserRepository::class);

        $user = $this->createMock(User::class);

        $userRepository->method('find')->willReturn($user);

        return $userRepository;
    }

    /**
     * @return void
     */
    public function testIndex(): void
    {
        // Create a mock UserRepository
        $userRepository = $this->createMockUserRepository(['City1', 'City2']);

        // Create the SubscribingListController instance with the mock UserRepository
        $controller = new SubscribingListController($userRepository);

        // Call the index method
        $response = $controller->index(123);

        // Assert that the response is an instance of Response
        $this->assertInstanceOf(Response::class, $response);

        // Assert the response content contains the expected data
        $this->assertStringContainsString('City1', $response->getContent());
        $this->assertStringContainsString('City2', $response->getContent());
    }
}
