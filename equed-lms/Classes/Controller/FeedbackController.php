<?php

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class FeedbackController extends ActionController
{
    /**
     * Display feedback form for a course or lesson
     */
    public function indexAction(int $courseId): void
    {
        // Fetch the course details and show feedback form
        $this->view->assign('courseId', $courseId);
    }

    /**
     * Submit feedback for a course or lesson
     */
    public function submitAction(int $courseId, string $feedback): void
    {
        // Process the feedback submission (e.g., save it to the database)
        $this->view->assign('feedbackStatus', 'Feedback submitted');
    }
}