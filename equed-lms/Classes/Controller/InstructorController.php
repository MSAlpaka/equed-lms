<?php

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Http\RedirectResponse;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use Equed\EquedLms\Domain\Repository\UserSubmissionRepository;
use Equed\EquedLms\Domain\Model\UserSubmission;
use TYPO3\CMS\Core\Resource\StorageRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Equed\EquedLms\Domain\Repository\UserCourseRecordRepository;
use Equed\EquedLms\Domain\Model\UserCourseRecord;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Core\Mail\MailMessage;
use Equed\EquedLms\Domain\Model\ExamAttempt;
use Equed\EquedLms\Domain\Repository\ExamAttemptRepository;
use Equed\EquedLms\Service\UserCourseRecordService;

class InstructorController extends ActionController
{
    protected PersistenceManager $persistenceManager;

    public function __construct(
        protected UserSubmissionRepository $userSubmissionRepository,
        protected UserCourseRecordRepository $userCourseRecordRepository,
        PersistenceManager $persistenceManager
    ) {
        $this->persistenceManager = $persistenceManager;
    }

    public function dashboardAction(): void
    {
        $user = $GLOBALS['TSFE']->fe_user['user'] ?? [];
        $userId = $user['uid'] ?? 0;

        if (!$userId || empty($user['is_instructor'])) {
            $this->addFlashMessage($this->translate('instructor.noAccess'), '', AbstractMessage::ERROR);
            $this->redirect('dashboard', 'Lms');
            return;
        }

        $submissions = $this->userSubmissionRepository->findAll();

        $this->view->assign('submissions', $submissions);
        $this->view->assign('instructorName', $user['name'] ?? $user['username']);
    }

    public function validateCourseAction(int $record)
    {
        $recordRepo = GeneralUtility::makeInstance(UserCourseRecordRepository::class);
        $examRepo = GeneralUtility::makeInstance(ExamAttemptRepository::class);

        $userCourseRecord = $recordRepo->findByUid($record);
        $examAttempts = $examRepo->findByUserCourseRecord($record);

        $this->view->assignMultiple([
            'record' => $userCourseRecord,
            'attempts' => $examAttempts,
            'newAttempt' => GeneralUtility::makeInstance(ExamAttempt::class),
        ]);
    }

    public function createExamAttemptAction(ExamAttempt $newAttempt)
    {
        $examRepo = GeneralUtility::makeInstance(ExamAttemptRepository::class);
        $recordService = GeneralUtility::makeInstance(UserCourseRecordService::class);

        $newAttempt->setAttemptDate(new \DateTime());
        $newAttempt->setInstructor($this->getCurrentFrontendUser());

        $course = $newAttempt->getRecord()->getCourse();
        $currentUser = $this->getCurrentFrontendUser();

        if ($course->getRequiresExternalExaminer()) {
            $assignedExaminer = $newAttempt->getRecord()->getExternalExaminer();
            if (!$assignedExaminer || $assignedExaminer->getUid() !== $currentUser?->getUid()) {
                $this->addFlashMessage(
                    'Nur die vom ServiceCenter zugewiesene Prüfperson darf Prüfversuche einreichen.',
                    '',
                    AbstractMessage::ERROR
                );
                $this->redirect('dashboard');
                return;
            }
        }

        $examRepo->add($newAttempt);
        $recordService->evaluateCompletionStatus($newAttempt->getRecord());

        $this->redirect('validateCourse', null, null, ['record' => $newAttempt->getRecord()->getUid()]);
    }

    protected function translate(string $key): string
    {
        return $GLOBALS['TSFE']->getLanguageService()->sL('LLL:EXT:equed_lms/Resources/Private/Language/locallang_instructor.xlf:' . $key);
    }

    protected function notifyCertifier(UserCourseRecord $record): void
    {
        $mail = GeneralUtility::makeInstance(MailMessage::class);
        $mail->setSubject('Neuer Kursabschluss zur Validierung');
        $mail->setFrom(['noreply@equed.eu' => 'EquEd LMS']);
        $mail->setTo('certifier@equed.eu'); // TODO: dynamisch machen
        $mail->setBody("Teilnehmer #{$record->getFeUser()} hat Kurs #{$record->getCourse()} abgeschlossen.\n\nZur Validierung: https://training.equed.eu/certifier/dashboard");
        $mail->send();
    }

    protected function getCurrentFrontendUser(): ?\Equed\EquedLms\Domain\Model\User
    {
        $userArray = $GLOBALS['TSFE']->fe_user['user'] ?? null;
        if ($userArray && isset($userArray['uid'])) {
            $user = GeneralUtility::makeInstance(\Equed\EquedLms\Domain\Model\User::class);
            $user->_setProperty('uid', (int)$userArray['uid']);
            return $user;
        }
        return null;
    }
}