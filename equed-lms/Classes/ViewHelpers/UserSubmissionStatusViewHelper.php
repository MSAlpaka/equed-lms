<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Equed\EquedLms\Domain\Repository\UserSubmissionRepository;

class UserSubmissionStatusViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('userId', 'int', 'User ID', true);
        $this->registerArgument('submissionId', 'int', 'Submission ID', true);
    }

    public function render(): string
    {
        $userId = (int)$this->arguments['userId'];
        $submissionId = (int)$this->arguments['submissionId'];

        $status = $this->getSubmissionStatus($userId, $submissionId);
        $key = $status ? 'submission.status.submitted' : 'submission.status.not_submitted';

        return LocalizationUtility::translate($key, 'equed_lms') ?? ($status ? 'Submitted' : 'Not Submitted');
    }

    protected function getSubmissionStatus(int $userId, int $submissionId): bool
    {
        /** @var UserSubmissionRepository $repository */
        $repository = GeneralUtility::makeInstance(UserSubmissionRepository::class);
        $submission = $repository->findByUserAndSubmission($userId, $submissionId);
        return $submission?->getStatus() === 'submitted';
    }
}