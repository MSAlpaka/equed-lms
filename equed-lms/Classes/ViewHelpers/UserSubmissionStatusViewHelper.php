<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class UserSubmissionStatusViewHelper extends AbstractViewHelper
{
    /**
     * @param int $userId
     * @param int $submissionId
     * @return string
     */
    public function render(int $userId, int $submissionId): string
    {
        // Fetch submission status for a user
        $status = $this->getSubmissionStatus($userId, $submissionId);
        return $status ? 'Submitted' : 'Not Submitted';
    }

    /**
     * Get the submission status for a specific user and submission
     *
     * @param int $userId
     * @param int $submissionId
     * @return bool
     */
    protected function getSubmissionStatus(int $userId, int $submissionId): bool
    {
        // Fetch submission status from the repository
        $repository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\Equed\EquedLms\Domain\Repository\UserSubmissionRepository::class);
        $submission = $repository->findByUserAndSubmission($userId, $submissionId);
        return $submission ? $submission->getStatus() === 'submitted' : false;
    }
}