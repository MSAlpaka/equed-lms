<?php

declare(strict_types=1);

namespace Equed\EquedLms\Service;

use Equed\EquedLms\Domain\Model\UserCourseRecord;
use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class NotificationService
{
    public function sendCourseCompletionNotification(UserCourseRecord $record): void
    {
        $user = $record->getUser();
        $course = $record->getCourse();
        $certifier = $record->getValidatedBy();
        $center = $record->getCenter();

        $subject = sprintf(
            'Course completed: %s by %s',
            $course?->getTitle() ?? '[Unknown Course]',
            $user?->getFullName() ?? '[Unknown User]'
        );

        $body = <<<BODY
A course was successfully completed and validated:

Participant: {$user?->getFullName()}
Course: {$course?->getTitle()}
Center: {$center?->getName()}
Validated by: {$certifier?->getFullName()}
Certificate Code: {$record->getCertificateCode()}

You can verify this at: https://verify.equed.eu/{$record->getCertificateCode()}
BODY;

        $mail = GeneralUtility::makeInstance(MailMessage::class);
        $mail->setSubject($subject);
        $mail->setFrom(['noreply@equed.eu' => 'EquEd LMS']);
        $mail->setTo(['admin@equed.eu']); // Später dynamisch anpassen
        $mail->text($body);
        $mail->send();
    }
}