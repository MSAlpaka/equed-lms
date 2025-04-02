<?php

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Equed\EquedLms\Domain\Repository\UserCourseRecordRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Equed\EquedLms\Domain\Model\UserCourseRecord;

class ServiceCenterController extends ActionController
{
    protected UserCourseRecordRepository $userCourseRecordRepository;

    public function __construct(UserCourseRecordRepository $userCourseRecordRepository)
    {
        $this->userCourseRecordRepository = $userCourseRecordRepository;
    }

    public function dashboardAction(): void
    {
        $user = $GLOBALS['TSFE']->fe_user['user'] ?? [];
        if (empty($user['is_servicecenter'])) {
            $this->addFlashMessage('Zugriff verweigert: Du bist kein ServiceCenter-Mitarbeiter.', '', AbstractMessage::ERROR);
            $this->redirect('dashboard', 'Lms');
            return;
        }

        // Alle offenen Prüfzuweisungen anzeigen
        $records = $this->userCourseRecordRepository->findByExternalExaminerNull();

        $this->view->assign('records', $records);
    }

    public function assignExternalExaminerAction(UserCourseRecord $record, int $examinerId): void
    {
        // Prüfer zuweisen
        $examiner = GeneralUtility::makeInstance(\\Equed\\EquedLms\\Domain\\Model\\User::class);
        $examiner->setUid($examinerId);
        $record->setExternalExaminer($examiner);

        $this->userCourseRecordRepository->update($record);

        // Bestätigung und Weiterleitung
        $this->addFlashMessage('Externe Prüfperson erfolgreich zugewiesen.');
        $this->redirect('dashboard');
    }
}