<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class CertificateUrlViewHelper extends AbstractViewHelper
{
    /**
     * @param int $userId
     * @param int $courseId
     * @return string
     */
    public function render(int $userId, int $courseId): string
    {
        // Generate the URL for the certificate
        $certificateUrl = $this->generateCertificateUrl($userId, $courseId);
        return $certificateUrl ? $certificateUrl : 'Certificate not available';
    }

    /**
     * Generate the URL for the user’s certificate
     *
     * @param int $userId
     * @param int $courseId
     * @return string|null
     */
    protected function generateCertificateUrl(int $userId, int $courseId): ?string
    {
        // Logic to generate the certificate URL
        return 'https://example.com/certificates/' . $userId . '/' . $courseId . '.pdf';
    }
}