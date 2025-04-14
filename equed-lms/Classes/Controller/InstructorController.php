<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Model\Course;
use EquedLms\Domain\Repository\CourseRepository;
use Psr\Log\LoggerInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Exception\AccessDeniedException;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Psr\Http\Message\ResponseInterface;

class InstructorController extends ActionController
{
    public function __construct(
        protected readonly CourseRepository $courseRepository,
        protected readonly LoggerInterface $logger
    ) {}

    /**
     * Submits feedback for an assigned course.
     */
    public function evaluateAction(int $courseId): ResponseInterface
    {
        $user = $this->getAuthenticatedUser();
        $course = $this->courseRepository->findByUid($courseId);

        if ($course && $course->getInstructor() === $user) {
            $feedback = $this->request->hasArgument('feedback') ? $this->request->getArgument('feedback') : null;

            if ($feedback) {
                $this->courseRepository->submitFeedback($courseId, $user, $feedback);
                $this->addFlashMessage(
                    LocalizationUtility::translate('flashMessages.feedbackSubmitted', 'EquedLms') ?? 'Feedback submitted successfully.',
                    '',
                    AbstractMessage::OK
                );
                $this->logger->info('Feedback submitted for course', [
                    'courseId' => $course->getUid(),
                    'instructorId' => $user->getUid()
                ]);
            } else {
                $this->addFlashMessage(
                    LocalizationUtility::translate('flashMessages.feedbackMissing', 'EquedLms') ?? 'Please provide feedback.',
                    '',
                    AbstractMessage::ERROR
                );
            }
        } else {
            $this->addFlashMessage(
                LocalizationUtility::translate('flashMessages.errorNotAssigned', 'EquedLms') ?? 'You are not assigned to this course.',
                '',
                AbstractMessage::ERROR
            );
        }

        return $this->redirect('index', 'Course');
    }

    /**
     * Marks the course as completed.
     */
    public function markCompleteAction(int $courseId): ResponseInterface
    {
        $user = $this->getAuthenticatedUser();
        $course = $this->courseRepository->findByUid($courseId);

        if ($course && $course->getInstructor() === $user) {
            $course->setStatus('completed');
            $this->courseRepository->update($course);

            $this->addFlashMessage(
                LocalizationUtility::translate('flashMessages.courseCompleted', 'EquedLms') ?? 'Course marked as completed.',
                '',
                AbstractMessage::OK
            );
            $this->logger->info('Course marked as completed', [
                'courseId' => $course->getUid(),
                'instructorId' => $user->getUid()
            ]);
        } else {
            $this->addFlashMessage(
                LocalizationUtility::translate('flashMessages.errorNotAssigned', 'EquedLms') ?? 'You are not assigned to this course.',
                '',
                AbstractMessage::ERROR
            );
        }

        return $this->redirect('index', 'Course');
    }

    /**
     * Returns the currently authenticated frontend user object.
     */
    protected function getAuthenticatedUser(): ?object
    {
        $context = GeneralUtility::makeInstance(Context::class);
        return $context->getPropertyFromAspect('frontend.user', 'user') ?: null;
    }
}