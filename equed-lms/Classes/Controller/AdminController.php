<?php

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use Equed\EquedLms\Domain\Repository\UserCourseRecordRepository;
use Equed\EquedLms\Domain\Model\UserCourseRecord;

class AdminController extends ActionController
{
    public function __construct(
        protected UserCourseRecordRepository $userCourseRecordRepository
    ) {}

    protected function isAuthorized(): bool
    {
        // TYPO3 BE-Admin hat immer Zugriff
        if (isset($GLOBALS['BE_USER']) && (bool)($GLOBALS['BE_USER']->isAdmin())) {
            return true;
        }

        // Alternativ: FE-User mit certifier-Flag
        $feUser = $GLOBALS['TSFE']->fe_user['user'] ?? [];
        return !empty($feUser['is_certifier']);
    }

    public function pendingRecordsAction(): void
    {
        if (!$this->isAuthorized()) {
            $this->addFlashMessage('Access denied. Only certifiers or backend admins allowed.', '', AbstractMessage::ERROR);
            $this->redirect('');
            return;
        }

        $records = $this->userCourseRecordRepository->findPendingValidation();
        $this->view->assign('records', $records);
    }

    public function validateRecordAction(int $recordId): void
    {
        if (!$this->isAuthorized()) {
            $this->addFlashMessage('Access denied. Only certifiers or backend admins allowed.', '', AbstractMessage::ERROR);
            $this->redirect('');
            return;
        }

        $record = $this->userCourseRecordRepository->findByUid($recordId);

        if (!$record instanceof UserCourseRecord) {
            $this->addFlashMessage('Record not found.', '', AbstractMessage::ERROR);
            $this->redirect('pendingRecords');
            return;
        }

        $beUserId = $GLOBALS['BE_USER']->user['uid'] ?? 0;
        $record->setCompletionValidated(true);
        $record->setValidatedBy((int)$beUserId);
        $record->setCertificateIssued(true);

        $this->userCourseRecordRepository->update($record);
        $this->addFlashMessage('Course validated and certificate issued.');
        $this->redirect('pendingRecords');
    }
}