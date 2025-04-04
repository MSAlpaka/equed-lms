<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Model\UserCourseRecord;
use EquedLms\Domain\Repository\CourseRepository;
use EquedLms\Domain\Repository\UserCourseRecordRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Extbase\Annotation\Inject;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;

class CourseBookingController extends ActionController
{
    #[Inject]
    protected CourseRepository $courseRepository;

    #[Inject]
    protected FrontendUserRepository $frontendUserRepository;

    #[Inject]
    protected UserCourseRecordRepository $userCourseRecordRepository;

    #[Inject]
    protected PersistenceManager $persistenceManager;

    protected function initializeView(ViewInterface $view): void
    {
        $GLOBALS['TSFE']->addCacheTags(['equedlms_courses']);
    }

    /**
     * Zeigt alle Kurse an
     */
    public function indexAction(): void
    {
        $courses = $this->courseRepository->findAll();
        $this->view->assign('courses', $courses);
    }

    /**
     * Ermöglicht die Buchung eines Kurses
     */
    public function bookAction(int $courseId): void
    {
        $user = $this->getCurrentFrontendUser();
        if (!$user) {
            $this->addFlashMessage(
                LocalizationUtility::translate('flashMessages.loginRequired', 'EquedLms'),
                '',
                \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR
            );
            $this->redirect('index');
        }

        $course = $this->courseRepository->findByIdentifier($courseId);
        if (!$course) {
            $this->addFlashMessage(
                LocalizationUtility::translate('flashMessages.courseNotFound', 'EquedLms'),
                '',
                \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR
            );
            $this->redirect('index');
        }

        $existingRecord = $this->userCourseRecordRepository->findOneByUserAndCourse($user, $course);
        if ($existingRecord) {
            $this->addFlashMessage(
                LocalizationUtility::translate('flashMessages.courseAlreadyBooked', 'EquedLms'),
                '',
                \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING
            );
            $this->redirect('index');
        }

        $record = new UserCourseRecord();
        $record->setUser($user);
        $record->setCourse($course);
        $record->setStatus('pending'); // Status könnte anpassbar sein

        $this->userCourseRecordRepository->add($record);
        $this->persistenceManager->persistAll();

        $this->addFlashMessage(
            LocalizationUtility::translate('flashMessages.courseBookingSuccess', 'EquedLms'),
            '',
            \TYPO3\CMS\Core\Messaging\AbstractMessage::OK
        );

        $this->redirect('index');
    }

    /**
     * Holt den aktuellen eingeloggten Benutzer
     */
    protected function getCurrentFrontendUser(): ?FrontendUser
    {
        $userId = (int)($GLOBALS['TSFE']->fe_user->user['uid'] ?? 0);
        return $userId > 0 ? $this->frontendUserRepository->findByUid($userId) : null;
    }
}