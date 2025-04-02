<?php

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class LmsController extends ActionController
{
    /**
     * Show LMS homepage or overview
     */
    public function indexAction(): void
    {
        // Logic to show the LMS homepage (overview of courses, instructors, etc.)
        $this->view->assign('lmsOverview', []);
    }
}