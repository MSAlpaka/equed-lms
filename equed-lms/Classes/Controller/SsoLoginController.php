<?php

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class SsoLoginController extends ActionController
{
    /**
     * Handle the SSO login process
     */
    public function loginAction(): void
    {
        // Trigger SSO login via OAuth or other system
        $this->view->assign('loginStatus', []);
    }
}