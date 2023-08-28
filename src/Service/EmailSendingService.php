<?php

namespace App\Service;

use App\Entity\Passenger;
use App\Security\EmailVerifier;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;

class EmailSendingService
{
    /**
     * @var EmailVerifier
     */
    private EmailVerifier $emailVerifier;


    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    /**
     * @param mixed $passenger
     * 
     * @return void
     */
    public function send(Passenger $passenger): void
    {
        $this->emailVerifier->sendEmailConfirmation(
            'app_verify_email',
            $passenger,
            (new TemplatedEmail())
                ->from(new Address('tikhonvasilevich@gmail.com', 'Air'))
                ->to($passenger->getEmail())
                ->subject('Please Confirm your Email')
                ->htmlTemplate('registration/confirmation_email.html.twig')
        );
    }
}
