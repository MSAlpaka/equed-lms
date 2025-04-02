<?php

declare(strict_types=1);

namespace Equed\EquedLms\Service;

use Equed\EquedLms\Domain\Model\UserCourseRecord;
use Equed\EquedLms\Domain\Repository\UserCourseRecordRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface;
use TYPO3\CMS\Core\Mail\MailMessage;
use Equed\EquedLms\Service\RoleService;
use Equed\EquedLms\Service\NotificationService;

class UserCourseRecordService
{
    protected UserCourseRecordRepository $recordRepository;
    protected PersistenceManagerInterface $persistenceManager;

    public function __construct(
        UserCourseRecordRepository $recordRepository,
        PersistenceManagerInterface $persistenceManager
    ) {
        $this->recordRepository = $recordRepository;
        $this->persistenceManager = $persistenceManager;
    }

    /**
     * Markiert einen Kurs für einen User als abgeschlossen und löst Folgeaktionen aus.
     */
    public function markAsCompleted(UserCourseRecord $record): void
    {
        if ($record->isValidated() && !$record->isCompleted()) {
            $record->setCompleted(true);

            if (!$record->getCertificateCode()) {
                $record->generateCertificateCode();
            }
            $record->generateQrCode();

            $this->recordRepository->update($record);

            $roleService = GeneralUtility::makeInstance(RoleService::class);
            $roleService->assignRolesAfterCertification($record);

            $notificationService = GeneralUtility::makeInstance(NotificationService::class);
            $notificationService->sendCourseCompletionNotification($record);

            $this->persistenceManager->persistAll();
        }
    }

    public function notifyServiceCenterIfExternalExaminerRequired(UserCourseRecord $record): void
    {
        $course = $record->getCourse();

        if (!$course->getRequiresExternalExaminer()) {
            return;
        }

        if ($record->getExternalExaminer()) {
            return;
        }

        $mail = GeneralUtility::makeInstance(MailMessage::class);
        $mail->setSubject('Externer Prüfer erforderlich');
        $mail->setFrom(['noreply@equed.eu' => 'EquEd LMS']);
        $mail->setTo('service@equed.eu');

        $body = sprintf(
            "Für den Kurs \"%s\" (ID: %d) wurde eine Buchung von %s (User-ID: %d) erstellt.\n\n" .
            "Dieser Kurs erfordert eine externe Prüfperson, aber es wurde noch keiner zugewiesen.\n\n" .
            "Bitte jetzt zuweisen unter:\nhttps://training.equed.eu/typo3/module/web/list/tx_equedlms_domain_model_usercourserecord\n\nMit freundlichen Grüßen,\nEquEd LMS",
            $course->getTitle(),
            $course->getUid(),
            $record->getUser()?->getFullName() ?? '(Unbekannt)',
            $record->getUser()?->getUid() ?? 0
        );

        $mail->setBody($body);
        $mail->send();
    }
}