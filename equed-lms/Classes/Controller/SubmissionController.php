<?php

declare(strict_types=1);

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Equed\EquedLms\Domain\Repository\SubmissionRepository;
use Equed\EquedLms\Domain\Repository\CourseRepository;
use Equed\EquedLms\Domain\Repository\UserRepository;
use Equed\EquedLms\Domain\Model\Submission;
use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException;

/**
 * Controller handling submissions within courses
 */
class SubmissionController extends ActionController
{
    protected SubmissionRepository $submissionRepository;
    protected CourseRepository $courseRepository;
    protected UserRepository $userRepository;

    public function injectSubmissionRepository(SubmissionRepository $submissionRepository): void
    {
        $this->submissionRepository = $submissionRepository;
    }

    public function injectCourseRepository(CourseRepository $courseRepository): void
    {
        $this->courseRepository = $courseRepository;
    }

    public function injectUserRepository(UserRepository $userRepository): void
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Show all submissions for a specific course
     */
    public function indexAction(int $courseId): void
    {
        $course = $this->courseRepository->findByUid($courseId);
        if (!$course) {
            $this->addFlashMessage('Course not found.', '', \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
            $this->redirect('list', 'Course');
        }

        $submissions = $this->submissionRepository->findByCourse($course);
        $this->view->assignMultiple([
            'course' => $course,
            'submissions' => $submissions
        ]);
    }

    /**
     * Handle the submission of reports or assignments
     */
    public function submitAction(int $userId, int $courseId, Submission $submission, ?FileReference $file = null): void
    {
        $user = $this->userRepository->findByUid($userId);
        $course = $this->courseRepository->findByUid($courseId);

        if (!$user || !$course) {
            $this->addFlashMessage('User or course not found.', '', \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
            $this->redirect('index', null, null, ['courseId' => $courseId]);
        }

        $existingSubmission = $this->submissionRepository->findByUserAndCourse($user, $course);
        if ($existingSubmission) {
            $this->addFlashMessage('You have already submitted for this course.', '', \TYPO3\CMS\Core\Messaging\FlashMessage::WARNING);
            $this->redirect('index', null, null, ['courseId' => $courseId]);
        }

        $submission->setUser($user);
        $submission->setCourse($course);
        $submission->setSubmissionDate(new \DateTime());

        if ($file) {
            $submission->setFile($file);
        }

        try {
            $this->submissionRepository->add($submission);
            $this->addFlashMessage('Submission successful.', '', \TYPO3\CMS\Core\Messaging\FlashMessage::OK);
        } catch (IllegalObjectTypeException $e) {
            $this->addFlashMessage('An error occurred during submission.', '', \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
        }

        $this->redirect('index', null, null, ['courseId' => $courseId]);
    }
}