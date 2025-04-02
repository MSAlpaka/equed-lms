<?php

declare(strict_types=1);

namespace Equed\EquedLms\Controller;

use Equed\EquedLms\Domain\Model\UserSubmission;
use Equed\EquedLms\Domain\Repository\UserSubmissionRepository;
use Equed\EquedLms\Domain\Repository\UserCourseRecordRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface;

class InstructorDashboardController extends ActionController
{
    protected UserSubmissionRepository $submissionRepository;
    protected UserCourseRecordRepository $recordRepository;
    protected PersistenceManagerInterface $persistenceManager;

    public function __construct(
        UserSubmissionRepository $submissionRepository,
        UserCourseRecordRepository $recordRepository,
        PersistenceManagerInterface $persistenceManager
    ) {
        $this->submissionRepository = $submissionRepository;
        $this->recordRepository = $recordRepository;
        $this->persistenceManager = $persistenceManager;
    }

    public function dashboardAction(): void
    {
        $userId = $GLOBALS['TSFE']->fe_user->user['uid'] ?? 0;
        $submissions = $this->submissionRepository->findByInstructor($userId);

        $this->view->assign('submissions', $submissions);
    }

    public function evaluateSubmissionAction(UserSubmission $submission): void
    {
        $record = $submission->getUserCourseRecord();

        $this->view->assignMultiple([
            'submission' => $submission,
            'record' => $record,
        ]);
    }

    public function saveEvaluationAction(UserSubmission $submission, string $instructorComment = '', bool $passed = false): void
    {
        $submission->setInstructorComment($instructorComment);
        $submission->setPassed($passed);

        $this->submissionRepository->update($submission);

        if ($passed) {
            $record = $submission->getUserCourseRecord();
            $record->setCompletionConfirmed(true);
            $record->setConfirmationDate(new \DateTime());
            $this->recordRepository->update($record);
        }

        $this->persistenceManager->persistAll();

        $this->addFlashMessage(
            $this->translate('evaluation.saved', 'equed_lms')
        );

        $this->redirect('dashboard');
    }

    protected function translate(string $key, string $extensionName): string
    {
        return $this->getLanguageService()->sL("LLL:EXT:$extensionName/Resources/Private/Language/locallang.xlf:$key");
    }

    protected function getLanguageService(): \TYPO3\CMS\Core\Localization\LanguageService
    {
        return $GLOBALS['LANG'];
    }
}