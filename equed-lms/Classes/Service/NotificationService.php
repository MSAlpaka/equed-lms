<?php

namespace Equed\EquedLms\Service;

class NotificationService
{
    /**
     * Send an email to the user
     */
    public function sendEmail(string $to, string $subject, string $message): void
    {
        // Use TYPO3 mail functionality to send an email
        $mail = \TYPO3\CMS\Core\Mail\MailMessage::create()
            ->setTo($to)
            ->setSubject($subject)
            ->setBody($message, 'text/plain');
        $mail->send();
    }
}