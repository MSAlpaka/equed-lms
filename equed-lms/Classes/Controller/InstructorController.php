<?php
// InstructorController.php

namespace Vendor\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Vendor\EquedLms\Domain\Model\Course;
use Vendor\EquedLms\Domain\Repository\CourseRepository;

class InstructorController extends ActionController
{
    /**
     * @var CourseRepository
     */
    protected $courseRepository;

    /**
     * @param CourseRepository $courseRepository
     */
    public function injectCourseRepository(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    /**
     * Evaluate action (only for assigned courses)
     */
    public function evaluateAction($courseId)
    {
        $user = $this->getAuthenticatedUser();
        $course = $this->courseRepository->findByUid($courseId);

        // Ensure the course is assigned to the current user (Instructor)
        if ($course && $course->getInstructor() === $user) {
            // Submit feedback for the course
            $this->courseRepository->submitFeedback($courseId, $user, $this->request->getArgument('feedback'));
            $this->addFlashMessage(
                $this->translate('feedback_submitted')
            );
        } else {
            $this->addFlashMessage(
                $this->translate('error_not_assigned_or_completed'),
                '',
                \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR
            );
        }
    }

    /**
     * Mark course as completed (only for assigned courses)
     */
    public function markCompleteAction($courseId)
    {
        $user = $this->getAuthenticatedUser();
        $course = $this->courseRepository->findByUid($courseId);

        if ($course && $course->getInstructor() === $user) {
            // Mark the course as completed
            $course->setStatus('completed');
            $this->courseRepository->update($course);
            $this->addFlashMessage(
                $this->translate('course_completed')
            );
        } else {
            $this->addFlashMessage(
                $this->translate('error_not_assigned_to_course'),
                '',
                \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR
            );
        }
    }

    /**
     * Helper function to get the authenticated user
     */
    protected function getAuthenticatedUser()
    {
        // Assuming we have a method to retrieve the logged-in user
        return $this->getUser();
    }

    /**
     * Helper function for translation
     */
    protected function translate($key)
    {
        return $this->getLocalizationService()->getLocalizedString($key);
    }
}
?>