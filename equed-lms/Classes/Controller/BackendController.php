<?php

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class BackendController extends ActionController
{
    /**
     * Admin Dashboard: Overview of system (e.g., users, courses, logs)
     */
    public function indexAction(): void
    {
        // Fetch dashboard data like course counts, active users, etc.
        $this->view->assign('dashboardData', []);
    }

    /**
     * Manage specific records (e.g., approve/reject courses, users)
     */
    public function manageAction(): void
    {
        // Admin-specific management tasks
        $this->view->assign('managementData', []);
    }
}