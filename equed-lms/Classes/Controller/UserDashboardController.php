<?php

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Annotation\Inject;
use TYPO3\CMS\Core\Localization\LanguageService;
use TYPO3\CMS\Core\Localization\LanguageServiceFactory;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use Equed\EquedLms\Domain\Repository\UserRepository;
use Equed\EquedLms\Domain\Repository\UserCourseRecordRepository;
use Equed\EquedLms\Domain\Repository\CertificateRepository;
use Psr\Http\Message\ServerRequestInterface;

class UserDashboardController extends ActionController
{
    #[Inject]
    protected UserRepository $userRepository;

    #[Inject]
    protected UserCourseRecordRepository $userCourseRecordRepository;

    #[Inject]
    protected CertificateRepository $certificateRepository;

    #[Inject]
    protected LanguageServiceFactory $languageServiceFactory;

    #[Inject]
    protected ServerRequestInterface $request;

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
            $this->forward('error');
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
     * Handles error view rendering
     */
    public function errorAction(): void
    {
        $this->view->assign('message', $this->translate('error.general'));
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
        $languageService = $this->getLanguageService();
        $label = 'LLL:EXT:equed_lms/Resources/Private/Language/locallang.xlf:' . $key;
        return $languageService->sL($label) ?? $key;
    }

    /**
     * Returns a modern LanguageService instance
     *
     * @return LanguageService
     */
    protected function getLanguageService(): LanguageService
    {
        $siteLanguage = $this->request->getAttribute('language');
        return $this->languageServiceFactory->createFromSiteLanguage($siteLanguage);
    }
}