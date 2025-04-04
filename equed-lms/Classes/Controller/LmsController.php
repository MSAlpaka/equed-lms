<?php

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Equed\EquedLms\Domain\Repository\CourseRepository;
use Equed\EquedLms\Domain\Repository\LessonRepository;
use Equed\EquedLms\Domain\Repository\UserCourseRecordRepository;
use TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

class LmsController extends ActionController
{
    protected CourseRepository $courseRepository;
    protected LessonRepository $lessonRepository;
    protected UserCourseRecordRepository $userCourseRecordRepository;

    public function __construct(
        CourseRepository $courseRepository,
        LessonRepository $lessonRepository,
        UserCourseRecordRepository $userCourseRecordRepository
    ) {
        $this->courseRepository = $courseRepository;
        $this->lessonRepository = $lessonRepository;
        $this->userCourseRecordRepository = $userCourseRecordRepository;
    }

    /**
     * LMS Overview page: Shows available courses.
     */
    public function indexAction(): void
    {
        $courses = $this->courseRepository->findAll();
        $this->view->assign('courses', $courses);
    }

    /**
     * Shows course details including lessons.
     *
     * @param int $courseId
     * @throws NoSuchArgumentException
     */
    public function showCourseAction(int $courseId): void
    {
        $course = $this->courseRepository->findByUid($courseId);
        if (!$course) {
            throw new NoSuchArgumentException(LocalizationUtility::translate('error.courseNotFound', 'equed_lms'));
        }
        $lessons = $this->lessonRepository->findByCourse($courseId);
        $this->view->assignMultiple([
            'course' => $course,
            'lessons' => $lessons
        ]);
    }

    /**
     * Lesson detail view including optional quiz.
     *
     * @param int $lessonId
     * @throws NoSuchArgumentException
     */
    public function lessonDetailAction(int $lessonId): void
    {
        $lesson = $this->lessonRepository->findByUid($lessonId);
        if (!$lesson) {
            throw new NoSuchArgumentException(LocalizationUtility::translate('error.lessonNotFound', 'equed_lms'));
        }
        $this->view->assign('lesson', $lesson);
    }

    /**
     * Processes quiz submission, updates progress.
     *
     * @param int $lessonId
     * @param array $quizAnswers
     */
    public function submitQuizAction(int $lessonId, array $quizAnswers): void
    {
        // TODO: Implement quiz logic and save user progress

        $this->redirect('lessonDetail', null, null, ['lessonId' => $lessonId]);
    }

    /**
     * Shows a user's course certificate.
     *
     * @param int $userCourseRecordId
     */
    public function viewCertificateAction(int $userCourseRecordId): void
    {
        $record = $this->userCourseRecordRepository->findByUid($userCourseRecordId);
        if ($record && $record->isCertified()) {
            $this->view->assign('certificate', $record);
        } else {
            $this->addFlashMessage(LocalizationUtility::translate('message.noCertificate', 'equed_lms'), '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
            $this->redirect('index');
        }
    }
}