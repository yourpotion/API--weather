<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    /**
     * @return void
     */
    public function testRegister(): void
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/register');
        $form = $crawler->selectButton('Register')->form();

        // Fill in the form fields with appropriate data
        $form['registration_form[email]'] = 'test@example.com';
        $form['registration_form[plainPassword]'] = 'testpassword';


        // Check if the user was redirected to the login page
        $this->assertResponseRedirects('/login');
    }

    /**
     * @return void
     */
    public function testVerifyUserEmail(): void
    {
        $client = static::createClient();

        // Create a mock UserRepository
        $userRepository = $this->createMock(UserRepository::class);
        $userRepository->expects($this->once())
            ->method('findOneBy')
            ->with(['email' => 'test@example.com'])
            ->willReturn($this->createMock(User::class)); // Creating a mock user

        $user = $this->createMock(User::class);

        // Authenticate the user (using real authentication)
        $client->loginUser($user);

        // Send a request to the verify email route
        $client->request('GET', '/verify/email');

        // Check if the user was redirected to the profile page
        $this->assertResponseRedirects('/profile');
    }
}
