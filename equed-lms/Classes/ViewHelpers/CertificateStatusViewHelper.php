<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class CertificateStatusViewHelper extends AbstractViewHelper
{
    /**
     * @param int $userId
     * @param int $courseId
     * @return string
     */
    public function render(int $userId, int $courseId): string
    {
        // Check if the user has a certificate for the course
        $certificate = $this->getCertificateForUser($userId, $courseId);
        return $certificate ? 'Certificate Issued' : 'No Certificate';
    }

    /**
     * Fetch the certificate for the user and course
     *
     * @param int $userId
     * @param int $courseId
     * @return \Equed\EquedLms\Domain\Model\Certificate|null
     */
    protected function getCertificateForUser(int $userId, int $courseId)
    {
        $certificateRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\Equed\EquedLms\Domain\Repository\CertificateRepository::class);
        return $certificateRepository->findByUserAndCourse($userId, $courseId);
    }
}