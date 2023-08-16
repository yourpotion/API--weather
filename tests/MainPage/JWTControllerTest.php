<?php

declare(strict_types=1);

use App\Controller\MainPage\JWTController;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\User\UserInterface;

class JWTControllerTest extends TestCase
{
    /**
     * @return void
     */
    public function testTokenCreation(): void
    {
        $testUser = $this->createMock(UserInterface::class);

        $jwtManager = $this->createMock(JWTTokenManagerInterface::class);

        $jwtManager->expects($this->once())
            ->method('create')
            ->willReturn('generated_token');

        $jwtController = (new JWTController())->index($jwtManager, $testUser);

        $this->assertEquals('generated_token', $jwtController);
    }
}
