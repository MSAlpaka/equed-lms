<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Equed\EquedLms\Domain\Repository\CertificateRepository;

class CertificateStatusViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('userId', 'int', 'User ID', true);
        $this->registerArgument('courseId', 'int', 'Course ID', true);
    }

    public function render(): string
    {
        $userId = (int)$this->arguments['userId'];
        $courseId = (int)$this->arguments['courseId'];

        $certificate = $this->getCertificateForUser($userId, $courseId);

        $labelKey = $certificate ? 'certificate.issued' : 'certificate.none';
        return LocalizationUtility::translate($labelKey, 'equed_lms') ?? ($certificate ? 'Certificate Issued' : 'No Certificate');
    }

    protected function getCertificateForUser(int $userId, int $courseId)
    {
        /** @var CertificateRepository $certificateRepository */
        $certificateRepository = GeneralUtility::makeInstance(CertificateRepository::class);
        return $certificateRepository->findByUserAndCourse($userId, $courseId);
    }
}