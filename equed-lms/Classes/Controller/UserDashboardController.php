<?php

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Equed\EquedLms\Domain\Repository\UserCourseRecordRepository;
use TYPO3\CMS\Core\Messaging\AbstractMessage;

class UserDashboardController extends ActionController
{
    public function __construct(
        protected UserCourseRecordRepository $userCourseRecordRepository
    ) {}

    public function dashboardAction(): void
    {
        $userId = $GLOBALS['TSFE']->fe_user['user']['uid'] ?? 0;

        if (!$userId) {
            $this->addFlashMessage(
                'Bitte melde dich an, um dein Dashboard zu sehen.',
                '',
                AbstractMessage::WARNING
            );
            $this->redirectToUri('/'); // später z. B. '/login' oder spezifische Login-Seite
            return;
        }

        $records = $this->userCourseRecordRepository->findByUser($userId);
        $this->view->assign('userCourseRecords', $records);
    }

    public function myCertificatesAction(): void
    {
        $userId = $GLOBALS['TSFE']->fe_user['user']['uid'] ?? 0;

        if (!$userId) {
            $this->addFlashMessage(
                'Bitte melde dich an, um deine Zertifikate zu sehen.',
                '',
                AbstractMessage::WARNING
            );
            $this->redirectToUri('/');
            return;
        }

        $records = $this->userCourseRecordRepository->findByFeUserAndValidated($userId);
        $this->view->assign('records', $records);
    }
}