<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

class CertificateUrlViewHelper extends AbstractViewHelper
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

        $certificateUrl = $this->generateCertificateUrl($userId, $courseId);

        return $certificateUrl
            ?? (LocalizationUtility::translate('certificate.not_available', 'equed_lms') ?? 'Certificate not available');
    }

    protected function generateCertificateUrl(int $userId, int $courseId): ?string
    {
        // TODO: Später dynamisch auf Basis gespeicherter Datei generieren
        return 'https://example.com/certificates/' . $userId . '/' . $courseId . '.pdf';
    }
}