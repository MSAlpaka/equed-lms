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
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ResponseInterface;

class CourseBookingController extends ActionController
{
    public function __construct(
        protected readonly CourseRepository $courseRepository,
        protected readonly UserCourseRecordRepository $userCourseRecordRepository,
        protected readonly PersistenceManager $persistenceManager,
        protected readonly LoggerInterface $logger
    ) {}

    /**
     * Displays all available courses.
     */
    public function indexAction(): ResponseInterface
    {
        $courses = $this->courseRepository->findAll();
        $this->view->assign('courses', $courses);
        return $this->htmlResponse();
    }

    /**
     * Books a course for the currently logged-in frontend user.
     */
    public function bookAction(int $courseId): ResponseInterface
    {
        $user = $this->getCurrentFrontendUser();

        if (!$user) {
            $this->addFlashMessage(
                LocalizationUtility::translate('flash.loginRequired', 'equed_lms') ?? 'Please log in first.',
                '',
                AbstractMessage::ERROR
            );
            $this->logger->warning('Course booking denied – user not logged in');
            return $this->redirect('index');
        }

        $course = $this->courseRepository->findByUid($courseId);

        if (!$course) {
            $this->addFlashMessage(
                LocalizationUtility::translate('flash.courseNotFound', 'equed_lms') ?? 'Course not found.',
                '',
                AbstractMessage::ERROR
            );
            $this->logger->warning('Course booking failed – course not found', ['courseId' => $courseId]);
            return $this->redirect('index');
        }

        $existingRecord = $this->userCourseRecordRepository->findOneByUserAndCourse($user, $course);
        if ($existingRecord) {
            $this->addFlashMessage(
                LocalizationUtility::translate('flash.courseAlreadyBooked', 'equed_lms') ?? 'You have already booked this course.',
                '',
                AbstractMessage::WARNING
            );
            $this->logger->info('User already booked this course', ['userId' => $user['uid'], 'courseId' => $courseId]);
            return $this->redirect('index');
        }

        if ($course->getStatus() === 'closed' || $course->getCapacity() <= 0) {
            $this->addFlashMessage(
                LocalizationUtility::translate('flash.courseUnavailable', 'equed_lms') ?? 'This course is no longer available.',
                '',
                AbstractMessage::WARNING
            );
            $this->logger->info('Course not available for booking', ['courseId' => $courseId]);
            return $this->redirect('index');
        }

        $record = new UserCourseRecord();
        $record->setFrontendUser($user);
        $record->setCourseInstance($course);

        $this->userCourseRecordRepository->add($record);
        $this->persistenceManager->persistAll();

        $this->addFlashMessage(
            LocalizationUtility::translate('flash.courseBooked', 'equed_lms') ?? 'You have successfully booked the course.',
            '',
            AbstractMessage::OK
        );
        $this->logger->info('Course booked', ['userId' => $user['uid'], 'courseId' => $courseId]);

        return $this->redirect('index');
    }

    /**
     * Returns the currently logged-in frontend user.
     */
    protected function getCurrentFrontendUser(): ?array
    {
        return $GLOBALS['TSFE']->fe_user->user ?? null;
    }
}
