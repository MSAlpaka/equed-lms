<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use EquedLms\Domain\Repository\UserRepository;
use EquedLms\Domain\Repository\UserCourseRecordRepository;
use EquedLms\Domain\Repository\CertificateRepository;
use EquedLms\Domain\Model\FrontendUser;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ResponseInterface;

class UserDashboardController extends ActionController
{
    public function __construct(
        protected readonly UserRepository $userRepository,
        protected readonly UserCourseRecordRepository $userCourseRecordRepository,
        protected readonly CertificateRepository $certificateRepository,
        protected readonly LoggerInterface $logger
    ) {}

    /**
     * Displays the dashboard for the currently logged-in frontend user.
     */
    public function indexAction(): ResponseInterface
    {
        $user = $this->getCurrentFrontendUser();

        if (!$user) {
            $this->addFlashMessage(
                LocalizationUtility::translate('error.userNotFound', 'equed_lms') ?? 'User not found.',
                '',
                AbstractMessage::ERROR
            );
            $this->logger->warning('Dashboard access denied – no user logged in.');
            return $this->redirect('error');
        }

        $courseRecords = $this->userCourseRecordRepository->findByUser($user);
        $certificates = $this->certificateRepository->findByUser($user);

        $this->view->assignMultiple([
            'user' => $user,
            'userCourseRecords' => $courseRecords,
            'certificates' => $certificates,
        ]);

        $this->logger->info('User dashboard loaded', ['userId' => $user->getUid()]);
        return $this->htmlResponse();
    }

    /**
     * Displays a general error message.
     */
    public function errorAction(): ResponseInterface
    {
        $this->view->assign(
            'message',
            LocalizationUtility::translate('error.general', 'equed_lms') ?? 'An unknown error occurred.'
        );
        return $this->htmlResponse();
    }

    /**
     * Returns the current logged-in frontend user.
     */
    protected function getCurrentFrontendUser(): ?FrontendUser
    {
        $userId = (int)($GLOBALS['TSFE']->fe_user->user['uid'] ?? 0);
        return $userId > 0 ? $this->userRepository->findByUid($userId) : null;
    }
}
