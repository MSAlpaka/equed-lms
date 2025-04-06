<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Model\UserCourseRecord;
use EquedLms\Domain\Repository\CourseRepository;
use EquedLms\Domain\Repository\UserCourseRecordRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Core\Authentication\FrontendUserAuthentication;

class CourseBookingController extends ActionController
{
    public function __construct(
        protected readonly CourseRepository $courseRepository,
        protected readonly UserCourseRecordRepository $userCourseRecordRepository,
        protected readonly PersistenceManager $persistenceManager
    ) {}

    /**
     * Zeigt alle verfügbaren Kurse an.
     */
    public function indexAction(): void
    {
        $courses = $this->courseRepository->findAll();
        $this->view->assign('courses', $courses);
    }

    /**
     * Bucht einen Kurs für den eingeloggten Benutzer.
     */
    public function bookAction(int $courseId): void
    {
        $user = $this->getCurrentFrontendUser();
        
        if (!$user) {
            $this->addFlashMessage(
                LocalizationUtility::translate('flashMessages.loginRequired', 'EquedLms') ?? 'Bitte zuerst einloggen.',
                '',
                AbstractMessage::ERROR
            );
            $this->redirect('index');
        }

        $course = $this->courseRepository->findByUid($courseId);
        
        if (!$course) {
            $this->addFlashMessage(
                LocalizationUtility::translate('flashMessages.courseNotFound', 'EquedLms') ?? 'Kurs nicht gefunden.',
                '',
                AbstractMessage::ERROR
            );
            $this->redirect('index');
        }

        // Überprüfen, ob der Benutzer bereits für den Kurs gebucht ist
        $existingRecord = $this->userCourseRecordRepository->findOneByUserAndCourse($user, $course);
        if ($existingRecord) {
            $this->addFlashMessage(
                LocalizationUtility::translate('flashMessages.courseAlreadyBooked', 'EquedLms') ?? 'Du hast diesen Kurs bereits gebucht.',
                '',
                AbstractMessage::WARNING
            );
            $this->redirect('index');
        }

        // Überprüfen, ob der Kurs noch buchbar ist (z. B. nicht ausgebucht)
        if ($course->getStatus() === 'closed' || $course->getCapacity() <= 0) {
            $this->addFlashMessage(
                LocalizationUtility::translate('flashMessages.courseNotAvailable', 'EquedLms') ?? 'Der Kurs ist nicht mehr verfügbar.',
                '',
                AbstractMessage::WARNING
            );
            $this->redirect('index');
        }

        // Neue Buchung anlegen
        $record = new UserCourseRecord();
        $record->setFrontendUser($user);
        $record->setCourseInstance($course);
        $record->setStatus('pending');  // Status könnte anpassbar sein

        $this->userCourseRecordRepository->add($record);
        $this->persistenceManager->persistAll();

        $this->addFlashMessage(
            LocalizationUtility::translate('flashMessages.courseBookingSuccess', 'EquedLms') ?? 'Kurs erfolgreich gebucht.',
            '',
            AbstractMessage::OK
        );

        $this->redirect('index');
    }

    /**
     * Gibt den aktuellen Frontend-User zurück.
     */
    protected function getCurrentFrontendUser(): ?FrontendUserAuthentication
    {
        return $GLOBALS['TSFE']->fe_user ?? null;
    }
}