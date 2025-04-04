<?php

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use Equed\EquedLms\Domain\Repository\UserRepository;
use Equed\EquedLms\Domain\Repository\UserCourseRecordRepository;
use Equed\EquedLms\Domain\Repository\CertificateRepository;

class UserDashboardController extends ActionController
{
    #[\TYPO3\CMS\Extbase\Annotation\Inject]
    protected UserRepository $userRepository;

    #[\TYPO3\CMS\Extbase\Annotation\Inject]
    protected UserCourseRecordRepository $userCourseRecordRepository;

    #[\TYPO3\CMS\Extbase\Annotation\Inject]
    protected CertificateRepository $certificateRepository;

    /**
     * Displays the dashboard for the currently logged-in user
     *
     * @param int $userId
     */
    public function indexAction(int $userId): void
    {
        $user = $this->userRepository->findByUid($userId);

        if ($user === null) {
            $this->addFlashMessage(
                $this->translate('error.userNotFound'),
                '',
                AbstractMessage::ERROR
            );
            $this->redirect('error');
            return;
        }

        $courseRecords = $this->userCourseRecordRepository->findByUser($userId);
        $certificates = $this->certificateRepository->findByUser($userId);

        $this->view->assignMultiple([
            'user' => $user,
            'userCourseRecords' => $courseRecords,
            'certificates' => $certificates,
        ]);
    }

    /**
     * Translation helper
     *
     * @param string $key
     * @param array $arguments
     * @return string
     */
    protected function translate(string $key, array $arguments = []): string
    {
        return $this->getLanguageService()->sL('LLL:EXT:equed_lms/Resources/Private/Language/locallang.xlf:' . $key, $arguments)
            ?? $key;
    }

    /**
     * Returns the LanguageService instance
     */
    protected function getLanguageService(): \TYPO3\CMS\Core\Localization\LanguageService
    {
        return $GLOBALS['LANG'] ?? $GLOBALS['BE_USER']->uc['lang'] ?? $GLOBALS['TSFE']->config['config']['language'] ?? 'default';
    }
}