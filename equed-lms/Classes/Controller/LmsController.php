<?php

declare(strict_types=1);

namespace Equed\EquedLms\Controller;

use Equed\EquedLms\Domain\Repository\CourseRepository;
use Equed\EquedLms\Domain\Repository\LessonRepository;
use Equed\EquedLms\Domain\Repository\UserCourseRecordRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Psr\Http\Message\ResponseInterface;

class LmsController extends ActionController
{
    public function __construct(
        protected readonly CourseRepository $courseRepository,
        protected readonly LessonRepository $lessonRepository,
        protected readonly UserCourseRecordRepository $userCourseRecordRepository
    ) {}

    /**
     * LMS Overview page: Shows available courses.
     */
    public function indexAction(): ResponseInterface
    {
        $courses = $this->courseRepository->findAll();
        $this->view->assign('courses', $courses);
        return $this->htmlResponse();
    }

    /**
     * Shows course details including lessons.
     */
    public function showCourseAction(int $courseId): ResponseInterface
    {
        $course = $this->courseRepository->findByUid($courseId);
        if (!$course) {
            throw new NoSuchArgumentException(
                LocalizationUtility::translate('error.courseNotFound', 'equed_lms') ?? 'Course not found.'
            );
        }

        $lessons = $this->lessonRepository->findByCourse($courseId);

        $this->view->assignMultiple([
            'course' => $course,
            'lessons' => $lessons
        ]);

        return $this->htmlResponse();
    }

    /**
     * Lesson detail view including optional quiz.
     */
    public function lessonDetailAction(int $lessonId): ResponseInterface
    {
        $lesson = $this->lessonRepository->findByUid($lessonId);
        if (!$lesson) {
            throw new NoSuchArgumentException(
                LocalizationUtility::translate('error.lessonNotFound', 'equed_lms') ?? 'Lesson not found.'
            );
        }

        $this->view->assign('lesson', $lesson);
        return $this->htmlResponse();
    }

    /**
     * Processes quiz submission and updates progress.
     */
    public function submitQuizAction(int $lessonId, array $quizAnswers): ResponseInterface
    {
        // TODO: Implement quiz validation and progress update
        // $this->quizService->evaluate($lessonId, $quizAnswers, $user);

        $this->addFlashMessage(
            LocalizationUtility::translate('quiz.submitted', 'equed_lms') ?? 'Your answers have been submitted.',
            '',
            AbstractMessage::OK
        );

        return $this->redirect('lessonDetail', null, null, ['lessonId' => $lessonId]);
    }

    /**
     * Displays a user's course certificate.
     */
    public function viewCertificateAction(int $userCourseRecordId): ResponseInterface
    {
        $userId = $this->getUserId();
        $record = $this->userCourseRecordRepository->findByUid($userCourseRecordId);

        if (!$record || $record->getUser()?->getUid() !== $userId) {
            $this->addFlashMessage(
                LocalizationUtility::translate('access.denied', 'equed_lms') ?? 'You are not allowed to view this certificate.',
                '',
                AbstractMessage::ERROR
            );
            return $this->redirect('index');
        }

        if (!$record->isCertified()) {
            $this->addFlashMessage(
                LocalizationUtility::translate('certificate.not_yet_ready', 'equed_lms') ?? 'Certificate not yet available.',
                '',
                AbstractMessage::NOTICE
            );
            return $this->redirect('index');
        }

        $this->view->assign('record', $record);
        return $this->htmlResponse();
    }

    /**
     * Returns current FE user ID.
     */
    protected function getUserId(): int
    {
        $context = GeneralUtility::makeInstance(Context::class);
        return (int)($context->getPropertyFromAspect('frontend.user', 'id') ?? 0);
    }
}
