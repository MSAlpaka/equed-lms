<?php

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class InstructorOnboardingController extends ActionController
{
    public function indexAction(): void
    {
        $user = $GLOBALS['TSFE']->fe_user['user'] ?? [];
        if (empty($user['uid']) || empty($user['is_instructor']) || !empty($user['onboarding_complete'])) {
            $this->redirect('dashboard', 'UserDashboard');
            return;
        }

        $this->view->assign('user', $user);
    }

    public function completeAction(): void
    {
        $feUserId = (int)($GLOBALS['TSFE']->fe_user['user']['uid'] ?? 0);
        if ($feUserId > 0) {
            $queryBuilder = $GLOBALS['TYPO3_DB']->exec_UPDATEquery(
                'fe_users',
                'uid = ' . $feUserId,
                ['onboarding_complete' => 1]
            );
        }
        $this->redirect('dashboard', 'UserDashboard');
    }
}