<?php

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class InstructorDashboardController extends ActionController
{
    /**
     * Show instructor's dashboard (overview of assigned students, courses)
     */
    public function indexAction(): void
    {
        // Display instructor-specific data
        $this->view->assign('instructorData', []);
    }

    /**
     * Show instructor's performance stats
     */
    public function performanceAction(int $instructorId): void
    {
        // Fetch instructor's performance statistics
        $this->view->assign('performanceStats', []);
    }
}