<?php

declare(strict_types=1);

namespace Equed\EquedLms\Controller;

use Equed\EquedLms\Domain\Model\Submission;
use Equed\EquedLms\Domain\Repository\SubmissionRepository;
use Equed\EquedLms\Domain\Repository\CourseRepository;
use Equed\EquedLms\Domain\Repository\UserRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Psr\Http\Message\ResponseInterface;

class SubmissionController extends ActionController
{
    public function __construct(
        protected readonly SubmissionRepository $submissionRepository,
        protected readonly CourseRepository $courseRepository,
        protected readonly UserRepository $userRepository
    ) {}

    /**
     * Show all submissions for a specific course.
     */
    public function indexAction(int $courseId): ResponseInterface
    {
        $course = $this->courseRepository->findByUid($courseId);

        if (!$course) {
            $this->addFlashMessage(
                LocalizationUtility::translate('flashMessages.courseNotFound', 'EquedLms') ?? 'Course not found.',
                '',
                AbstractMessage::ERROR
            );
            return $this->redirect('list', 'Course');
        }

        $submissions = $this->submissionRepository->findByCourse($course);

        $this->view->assignMultiple([
            'course' => $course,
            'submissions' => $submissions
        ]);

        return $this->htmlResponse();
    }

    /**
     * Handle the submission of reports or assignments.
     */
    public function submitAction(int $userId, int $courseId, Submission $submission, ?FileReference $file = null): ResponseInterface
    {
        $user = $this->userRepository->findByUid($userId);
        $course = $this->courseRepository->findByUid($courseId);

        if (!$user || !$course) {
            $this->addFlashMessage(
                LocalizationUtility::translate('flashMessages.userOrCourseNotFound', 'EquedLms') ?? 'User or course not found.',
                '',
                AbstractMessage::ERROR
            );
            return $this->redirect('index', null, null, ['courseId' => $courseId]);
        }

        $existingSubmission = $this->submissionRepository->findByUserAndCourse($user, $course);
        if ($existingSubmission) {
            $this->addFlashMessage(
                LocalizationUtility::translate('flashMessages.submissionExists', 'EquedLms') ?? 'You have already submitted for this course.',
                '',
                AbstractMessage::WARNING
            );
            return $this->redirect('index', null, null, ['courseId' => $courseId]);
        }

        $submission->setUser($user);
        $submission->setCourse($course);
        $submission->setSubmissionDate(new \DateTime());

        if ($file) {
            $submission->setFile($file);
        }

        $this->submissionRepository->add($submission);

        $this->addFlashMessage(
            LocalizationUtility::translate('flashMessages.submissionSuccess', 'EquedLms') ?? 'Submission successful.',
            '',
            AbstractMessage::OK
        );

        return $this->redirect('index', null, null, ['courseId' => $courseId]);
    }
}
