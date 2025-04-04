<?php

namespace Equed\EquedLms\Controller;

use Equed\EquedLms\Domain\Model\UserCourseRecord;
use Equed\EquedLms\Domain\Repository\CourseRepository;
use Equed\EquedLms\Domain\Repository\UserCourseRecordRepository;
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

    public function indexAction(): void
    {
        $courses = $this->courseRepository->findAll();
        $this->view->assign('courses', $courses);
    }

    public function bookAction(int $courseId): void
    {
        $user = $this->getCurrentFrontendUser();
        if (!$user) {
            $this->addFlashMessage('Du musst eingeloggt sein, um einen Kurs zu buchen.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
            $this->redirect('index');
        }

        $course = $this->courseRepository->findByIdentifier($courseId);
        if (!$course) {
            $this->addFlashMessage('Kurs nicht gefunden.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
            $this->redirect('index');
        }

        $existingRecord = $this->userCourseRecordRepository->findOneByUserAndCourse($user, $course);
        if ($existingRecord) {
            $this->addFlashMessage('Du hast diesen Kurs bereits gebucht.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
            $this->redirect('index');
        }

        $record = new UserCourseRecord();
        $record->setUser($user);
        $record->setCourse($course);
        $record->setStatus('pending');

        $this->userCourseRecordRepository->add($record);
        $this->persistenceManager->persistAll();

        $this->addFlashMessage('Kursbuchung erfolgreich!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->redirect('index');
    }

    protected function getCurrentFrontendUser(): ?FrontendUser
    {
        $userId = (int)($GLOBALS['TSFE']->fe_user->user['uid'] ?? 0);
        return $userId > 0 ? $this->frontendUserRepository->findByUid($userId) : null;
    }
}