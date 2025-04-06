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

class InstructorController extends ActionController
{
    public function __construct(
        protected readonly CourseRepository $courseRepository,
        protected readonly LoggerInterface $logger
    ) {}

    /**
     * Bewertet einen Kurs (nur zugewiesene Kurse).
     */
    public function evaluateAction(int $courseId): void
    {
        $user = $this->getAuthenticatedUser();
        $course = $this->courseRepository->findByUid($courseId);

        // Ensure the course is assigned to the current user (Instructor)
        if ($course && $course->getInstructor() === $user) {
            $feedback = $this->request->getArgument('feedback');
            if ($feedback) {
                // Submit feedback for the course
                $this->courseRepository->submitFeedback($courseId, $user, $feedback);
                $this->addFlashMessage(
                    LocalizationUtility::translate('flashMessages.feedbackSubmitted', 'EquedLms') ?? 'Feedback erfolgreich abgegeben.',
                    '',
                    AbstractMessage::OK
                );
                $this->logger->info('Feedback submitted for course', [
                    'courseId' => $course->getUid(),
                    'instructorId' => $user->getUid()
                ]);
            } else {
                $this->addFlashMessage(
                    LocalizationUtility::translate('flashMessages.feedbackMissing', 'EquedLms') ?? 'Bitte gib dein Feedback ab.',
                    '',
                    AbstractMessage::ERROR
                );
            }
        } else {
            $this->addFlashMessage(
                LocalizationUtility::translate('flashMessages.errorNotAssigned', 'EquedLms') ?? 'Du bist diesem Kurs nicht zugewiesen.',
                '',
                AbstractMessage::ERROR
            );
        }
    }

    /**
     * Markiert den Kurs als abgeschlossen (nur zugewiesene Kurse).
     */
    public function markCompleteAction(int $courseId): void
    {
        $user = $this->getAuthenticatedUser();
        $course = $this->courseRepository->findByUid($courseId);

        if ($course && $course->getInstructor() === $user) {
            // Mark the course as completed
            $course->setStatus('completed');
            $this->courseRepository->update($course);

            $this->addFlashMessage(
                LocalizationUtility::translate('flashMessages.courseCompleted', 'EquedLms') ?? 'Kurs erfolgreich abgeschlossen.',
                '',
                AbstractMessage::OK
            );
            $this->logger->info('Course marked as completed', [
                'courseId' => $course->getUid(),
                'instructorId' => $user->getUid()
            ]);
        } else {
            $this->addFlashMessage(
                LocalizationUtility::translate('flashMessages.errorNotAssignedToCourse', 'EquedLms') ?? 'Du bist diesem Kurs nicht zugewiesen.',
                '',
                AbstractMessage::ERROR
            );
        }
    }

    /**
     * Helper function to get the authenticated user.
     */
    protected function getAuthenticatedUser()
    {
        return $GLOBALS['TSFE']->fe_user->user;
    }
}