<?php

namespace App\Security;

use Scheb\TwoFactorBundle\Model\Email\TwoFactorInterface;
use Scheb\TwoFactorBundle\Mailer\AuthCodeMailerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class MyAuthCodeMailer implements AuthCodeMailerInterface
{

    public function __construct(private readonly MailerInterface $mailer, private readonly Environment $twig)
    {
    }

    public function sendAuthCode(TwoFactorInterface $user): void
    {
        $authCode = $user->getEmailAuthCode();

        $htmlContent = $this->twig->render('email/two_factor_auth_code.html.twig', [
            'user' => $user,
            'authCode' => $authCode
        ]);

        $email = (new Email())
            ->from('hello@demomailtrap.com')
            ->to($user->getEmail())
            ->subject("Votre code d'authentification à deux facteurs")
            ->html($htmlContent);

        $this->mailer->send($email);
    }
}