<?php
// InstructorDashboardController.php

namespace Vendor\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Vendor\EquedLms\Domain\Model\Course;
use Vendor\EquedLms\Domain\Repository\CourseRepository;

class InstructorDashboardController extends ActionController
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
     * Action to display the dashboard for the instructor
     */
    public function indexAction()
    {
        $user = $this->getAuthenticatedUser();
        
        // Retrieve all courses assigned to the current instructor
        $assignedCourses = $this->courseRepository->findAssignedCoursesByInstructor($user);

        $this->view->assign('assignedCourses', $assignedCourses);
    }

    /**
     * Action to display the feedback form for a specific course
     */
    public function feedbackAction($courseId)
    {
        $user = $this->getAuthenticatedUser();
        $course = $this->courseRepository->findByUid($courseId);

        // Ensure that the course is assigned to the current user (Instructor)
        if ($course && $course->getInstructor() === $user) {
            $this->view->assign('course', $course);
        } else {
            $this->addFlashMessage(
                $this->translate('error_not_assigned_to_course'),
                '',
                \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR
            );
            $this->redirect('index');
        }
    }

    /**
     * Action to submit feedback for a specific course
     */
    public function submitFeedbackAction($courseId)
    {
        $user = $this->getAuthenticatedUser();
        $course = $this->courseRepository->findByUid($courseId);

        // Ensure that the course is assigned to the current user (Instructor)
        if ($course && $course->getInstructor() === $user) {
            // Submit feedback for the course
            $feedback = $this->request->getArgument('feedback');
            $this->courseRepository->submitFeedback($courseId, $user, $feedback);
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

        $this->redirect('index');
    }

    /**
     * Action to mark the course as completed
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

        $this->redirect('index');
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