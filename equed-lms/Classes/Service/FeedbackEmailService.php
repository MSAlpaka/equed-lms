<?php

namespace Equed\EquedLms\Service;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Mail\MailMessage;
use Equed\EquedLms\Domain\Model\UserCourseRecord;
use TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface;
use Equed\EquedLms\Domain\Repository\UserCourseRecordRepository;

class FeedbackEmailService
{
    protected UserCourseRecordRepository $userCourseRecordRepository;
    protected PersistenceManagerInterface $persistenceManager;

    public function __construct(
        UserCourseRecordRepository $userCourseRecordRepository,
        PersistenceManagerInterface $persistenceManager
    ) {
        $this->userCourseRecordRepository = $userCourseRecordRepository;
        $this->persistenceManager = $persistenceManager;
    }

    public function sendFeedbackRequestEmail(UserCourseRecord $record): void
    {
        $user = $record->getUser();
        $course = $record->getCourse();

        if ($user && $course) {
            $mail = GeneralUtility::makeInstance(MailMessage::class);
            $mail->setSubject($this->getLocalizedString('feedback.email.subject', [$course->getTitle()]));
            $mail->setFrom(['noreply@equed.eu' => $this->getLocalizedString('feedback.email.from')]);
            $mail->setTo($user->getEmail());

            // Hier wird der persönliche Link zum Feedbackformular generiert
            $feedbackLink = $this->getFeedbackLink($record);

            $mailBody = sprintf(
                $this->getLocalizedString('feedback.email.body', [
                    $user->getFullName(),
                    $course->getTitle(),
                    $feedbackLink
                ])
            );

            $mail->setBody($mailBody);
            $mail->send();
        }
    }

    protected function generateFeedbackToken(UserCourseRecord $record): string
    {
        return hash('sha256', $record->getUid() . time() . 'feedback-token'); // Beispielhafte Token-Generierung
    }

    // Methoden zur Lokalisierung der E-Mail-Inhalte
    protected function getLocalizedString(string $key, array $params = []): string
    {
        return vsprintf($GLOBALS['TSFE']->getLL($key), $params);
    }

    // Link für das Feedback-Formular
    protected function getFeedbackLink(UserCourseRecord $record): string
    {
        return 'https://training.equed.eu/feedback/form/' . $record->getUid() . '?token=' . $this->generateFeedbackToken($record);
    }
}