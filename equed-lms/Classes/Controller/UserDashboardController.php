<?php

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class UserDashboardController extends ActionController
{
    /**
     * Show the user's dashboard (courses, progress, certificates)
     */
    public function indexAction(int $userId): void
    {
        // Logic to fetch user's courses, progress, certificates
        $this->view->assign('userDashboardData', []);
    }
}