<?php

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use Equed\EquedLms\Domain\Model\UserCourseRecord;
use Equed\EquedLms\Domain\Repository\UserCourseRecordRepository;
use Equed\EquedLms\Domain\Repository\ExamAttemptRepository;
use Equed\EquedLms\Service\UserCourseRecordService;
use Equed\EquedLms\Domain\Model\User;

class CertifierController extends ActionController
{
    public function __construct(
        protected UserCourseRecordRepository $userCourseRecordRepository,
        protected ExamAttemptRepository $examAttemptRepository,
        protected UserCourseRecordService $userCourseRecordService,
        protected PersistenceManager $persistenceManager
    ) {}

    public function dashboardAction(): void
    {
        $user = $GLOBALS['TSFE']->fe_user['user'] ?? [];
        if (empty($user['is_certifier'])) {
            $this->addFlashMessage('Zugriff verweigert: Du bist kein Certifier.', '', AbstractMessage::ERROR);
            $this->redirect('dashboard', 'Lms');
            return;
        }

        $pendingValidations = $this->userCourseRecordRepository->findPendingValidations();
        $this->view->assign('records', $pendingValidations);
    }

    public function validateCourseAction(UserCourseRecord $record): void
    {
        $this->userCourseRecordService->evaluateCompletionStatus($record);
        $attempts = $this->examAttemptRepository->findByUserCourseRecord($record->getUid());

        $this->view->assignMultiple([
            'record' => $record,
            'attempts' => $attempts,
        ]);
    }

    public function confirmValidationAction(int $record)
    {
        $userCourseRecord = $this->userCourseRecordRepository->findByUid($record);

        if (!$userCourseRecord instanceof UserCourseRecord) {
            $this->addFlashMessage('Datensatz nicht gefunden.', '', AbstractMessage::ERROR);
            $this->redirect('dashboard');
            return;
        }

        $userCourseRecord->setValidated(true);
        $userCourseRecord->setValidatedBy($this->getCurrentFrontendUser());
        $userCourseRecord->generateCertificateCode();
        $userCourseRecord->generateQrCode();

        $this->userCourseRecordRepository->update($userCourseRecord);
        $this->userCourseRecordService->markAsCompleted($userCourseRecord);
        $this->persistenceManager->persistAll();

        $this->addFlashMessage('Zertifizierung erfolgreich bestätigt.');
        $this->redirect('dashboard');
    }

    public function rejectValidationAction(int $record)
    {
        $userCourseRecord = $this->userCourseRecordRepository->findByUid($record);

        if (!$userCourseRecord instanceof UserCourseRecord) {
            $this->addFlashMessage('Datensatz nicht gefunden.', '', AbstractMessage::ERROR);
            $this->redirect('dashboard');
            return;
        }

        $userCourseRecord->setQmsCaseOpen(true);
        $userCourseRecord->setValidated(false);
        $userCourseRecord->setValidatedBy(null);

        $this->userCourseRecordRepository->update($userCourseRecord);
        $this->persistenceManager->persistAll();

        $this->addFlashMessage('Validierung abgelehnt. QMS-Fall wurde eröffnet.', '', AbstractMessage::WARNING);
        $this->redirect('dashboard');
    }

    protected function getCurrentFrontendUser(): ?User
    {
        $userArray = $GLOBALS['TSFE']->fe_user['user'] ?? null;
        if ($userArray && isset($userArray['uid'])) {
            $user = GeneralUtility::makeInstance(User::class);
            $user->_setProperty('uid', (int)$userArray['uid']);
            return $user;
        }
        return null;
    }
}