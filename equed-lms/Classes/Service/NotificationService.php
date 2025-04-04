<?php

declare(strict_types=1);

namespace Equed\EquedLms\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Psr\Log\LoggerInterface;

/**
 * Service to send plain text notifications
 */
class NotificationService
{
    public function __construct(
        private readonly MailerInterface $mailer,
        private readonly LoggerInterface $logger
    ) {}

    /**
     * Send a simple notification email
     *
     * @param string $to
     * @param string $subject
     * @param string $message
     */
    public function sendEmail(string $to, string $subject, string $message): void
    {
        try {
            $email = (new Email())
                ->from('noreply@equed.eu')
                ->to($to)
                ->subject($subject)
                ->text($message);

            $this->mailer->send($email);
        } catch (\Throwable $e) {
            $this->logger->error('Notification email failed to send', [
                'to' => $to,
                'subject' => $subject,
                'error' => $e->getMessage(),
            ]);
        }
    }
}