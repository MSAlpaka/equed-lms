<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Repository\UserCourseRecordRepository;
use EquedLms\Service\VerificationService;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Exception\AccessDeniedException;
use TYPO3\CMS\Core\Messaging\AbstractMessage;

class VerifyController extends ActionController
{
    protected UserCourseRecordRepository $userCourseRecordRepository;
    protected VerificationService $verificationService;

    public function __construct(
        UserCourseRecordRepository $userCourseRecordRepository,
        VerificationService $verificationService
    ) {
        $this->userCourseRecordRepository = $userCourseRecordRepository;
        $this->verificationService = $verificationService;
    }

    /**
     * Verifiziert die Kursabschlussdaten des Benutzers
     */
    public function indexAction(int $userId = 0, int $courseId = 0): void
    {
        if ($userId === 0 || $courseId === 0) {
            $this->addFlashMessage(
                $this->translate('verify.error.missingParameters'),
                '',
                AbstractMessage::ERROR
            );
            $this->redirect('error');
        }

        $userCourseRecord = $this->userCourseRecordRepository->findOneByUserAndCourse($userId, $courseId);

        if (!$userCourseRecord) {
            $this->addFlashMessage(
                $this->translate('verify.error.noRecordFound'),
                '',
                AbstractMessage::ERROR
            );
            $this->redirect('error');
        }

        // Zugriffssteuerung könnte hier eingefügt werden
        $this->checkPermissions($userCourseRecord);

        $verificationStatus = $this->verificationService->verifyCourseCompletion($userCourseRecord);

        $this->view->assignMultiple([
            'userCourseRecord' => $userCourseRecord,
            'verificationStatus' => $verificationStatus
        ]);
    }

    /**
     * Überprüft, ob der Benutzer Berechtigungen hat
     */
    protected function checkPermissions($userCourseRecord): void
    {
        $user = $this->getCurrentUser();

        if (!$user || !$user->hasPermissionToVerifyCourse($userCourseRecord)) {
            throw new AccessDeniedException($this->translate('accessDenied.verify'));
        }
    }

    /**
     * Holt den aktuellen eingeloggten Benutzer
     */
    protected function getCurrentUser(): ?\EquedLms\Domain\Model\FrontendUser
    {
        $userId = (int)($GLOBALS['TSFE']->fe_user->user['uid'] ?? 0);
        return $userId > 0 ? $this->userRepository->findByUid($userId) : null;
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
     * Holt den LanguageService für Übersetzungen
     */
    protected function getLanguageService()
    {
        return $GLOBALS['TSFE']->getLanguageService();
    }

    /**
     * Fehlerseite
     */
    public function errorAction(): void
    {
        $this->view->assign('message', $this->translate('verify.error.general'));
    }
}