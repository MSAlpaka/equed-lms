<?php

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Equed\EquedLms\Domain\Repository\UserSubmissionRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class SubmissionController extends ActionController
{
    protected UserSubmissionRepository $userSubmissionRepository;

    public function __construct(UserSubmissionRepository $userSubmissionRepository)
    {
        $this->userSubmissionRepository = $userSubmissionRepository;
    }

    public function mySubmissionsAction(): void
    {
        $feUser = $GLOBALS['TSFE']->fe_user->user ?? null;
        if (!$feUser) {
            $this->addFlashMessage($this->translate('submission.loginRequired'));
            $this->redirectToUri('/login');
            return;
        }

        $submissions = $this->userSubmissionRepository->findByFeUser((int)$feUser['uid']);
        $this->view->assign('submissions', $submissions);
    }

    protected function translate(string $key): string
    {
        return $this->getLanguageService()->sL('LLL:EXT:equed_lms/Resources/Private/Language/locallang_submission.xlf:' . $key);
    }

    protected function getLanguageService(): \TYPO3\CMS\Core\Localization\LanguageService
    {
        return $GLOBALS['LANG'] ?? $GLOBALS['TSFE']->getLanguageService();
    }
}