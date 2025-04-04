<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Annotation\Inject;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use EquedLms\Domain\Repository\UserRepository;
use EquedLms\Domain\Repository\UserCourseRecordRepository;
use EquedLms\Domain\Repository\CertificateRepository;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Exception\AccessDeniedException;

class UserDashboardController extends ActionController
{
    #[Inject]
    protected UserRepository $userRepository;

    #[Inject]
    protected UserCourseRecordRepository $userCourseRecordRepository;

    #[Inject]
    protected CertificateRepository $certificateRepository;

    /**
     * Zeigt das Dashboard für den aktuellen Benutzer an.
     */
    public function indexAction(): void
    {
        $user = $this->getCurrentFrontendUser();
        
        if (!$user) {
            $this->addFlashMessage(
                $this->translate('error.userNotFound'),
                '',
                AbstractMessage::ERROR
            );
            $this->forward('error');
            return;
        }

        $courseRecords = $this->userCourseRecordRepository->findByUser($user);
        $certificates = $this->certificateRepository->findByUser($user);

        $this->view->assignMultiple([
            'user' => $user,
            'userCourseRecords' => $courseRecords,
            'certificates' => $certificates,
        ]);
    }

    /**
     * Fehlerbehandlungsansicht
     */
    public function errorAction(): void
    {
        $this->view->assign('message', $this->translate('error.general'));
    }

    /**
     * Übersetzungs-Helper für die Sprachdateien
     */
    protected function translate(string $key, array $arguments = []): string
    {
        $languageService = $this->getLanguageService();
        $label = 'LLL:EXT:equed_lms/Resources/Private/Language/locallang.xlf:' . $key;
        return $languageService->sL($label) ?? $key;
    }

    /**
     * Holt den aktuellen eingeloggten Benutzer
     */
    protected function getCurrentFrontendUser(): ?\EquedLms\Domain\Model\FrontendUser
    {
        $userId = (int)($GLOBALS['TSFE']->fe_user->user['uid'] ?? 0);
        return $userId > 0 ? $this->userRepository->findByUid($userId) : null;
    }

    /**
     * Holt den LanguageService für Übersetzungen
     */
    protected function getLanguageService()
    {
        return $GLOBALS['TSFE']->getLanguageService();
    }
}