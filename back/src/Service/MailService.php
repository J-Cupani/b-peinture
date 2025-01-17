<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;

class MailService
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function activationEmail(User $user): void
    {
        $message = (new TemplatedEmail())
            ->from($_ENV['EMAIL_SENDER'])
            ->to($user->getEmail())
            ->subject($_ENV['SITE_NAME'] . ' - Validation de votre compte')
            ->htmlTemplate('email/activation-user.html.twig')
            ->context([
                'user' => $user,
                'ip' => array_key_exists('REMOTE_ADDR', $_SERVER) ? $_SERVER['REMOTE_ADDR'] : 'local'
            ]);

        $this->mailer->send($message);
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function forgetEMail(User $user): void
    {
        $message = (new TemplatedEmail())
            ->from($_ENV['EMAIL_SENDER'])
            ->to($user->getEmail())
            ->subject($_ENV['SITE_NAME'] . ' - Demande de nouveau mot de passe')
            ->htmlTemplate('email/lost-password.html.twig')
            ->context([
                'user' => $user,
                'ip' => array_key_exists('REMOTE_ADDR', $_SERVER) ? $_SERVER['REMOTE_ADDR'] : 'local'
            ]);

        $this->mailer->send($message);
    }

    public function sendContactEmail(string $subject, array $context = []): void
    {
        $email = (new TemplatedEmail())
            ->from($_ENV['EMAIL_SENDER'])
            ->to('contact@c4dev.fr')
            ->subject($subject)
            ->htmlTemplate('email/send-contact.html.twig')
            ->context($context);

        $this->mailer->send($email);
    }
}
