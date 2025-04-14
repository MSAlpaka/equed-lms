<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Model\Certificate;
use EquedLms\Domain\Model\UserCourseRecord;
use EquedLms\Domain\Repository\CertificateRepository;
use EquedLms\Domain\Repository\UserCourseRecordRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Authentication\FrontendUserAuthentication;
use TYPO3\CMS\Core\Exception\AccessDeniedException;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ResponseInterface;
use Mpdf\Mpdf;

class CertificateController extends ActionController
{
    public function __construct(
        protected readonly UserCourseRecordRepository $recordRepository,
        protected readonly CertificateRepository $certificateRepository,
        protected readonly LoggerInterface $logger
    ) {}

    /**
     * Displays the certificate preview as a frontend card.
     *
     * @throws AccessDeniedException
     */
    public function showCardAction(UserCourseRecord $record): ResponseInterface
    {
        $this->ensureAccess($record);

        $certificate = $this->certificateRepository->findByUserCourseRecord($record)
            ?? $this->createPlaceholderCertificate($record);

        $this->logger->info('Certificate preview shown', [
            'recordId' => $record->getUid(),
            'userId' => $this->getFrontendUserId()
        ]);

        $this->view->assignMultiple([
            'certificate' => $certificate,
            'record' => $record,
        ]);

        return $this->htmlResponse();
    }

    /**
     * Generates and streams a PDF certificate file.
     *
     * @throws AccessDeniedException
     */
    public function downloadPdfAction(UserCourseRecord $record): void
    {
        $this->ensureAccess($record);

        $certificate = $this->certificateRepository->findByUserCourseRecord($record)
            ?? $this->createPlaceholderCertificate($record);

        $html = $this->generatePdfHtml($certificate, $record);

        /** @var Mpdf $mpdf */
        $mpdf = GeneralUtility::makeInstance(Mpdf::class);
        $mpdf->WriteHTML($html);

        $fileName = 'Certificate_' . $certificate->getCode() . '.pdf';

        $this->logger->info('Certificate PDF generated/downloaded', [
            'recordId' => $record->getUid(),
            'userId' => $this->getFrontendUserId(),
            'code' => $certificate->getCode(),
        ]);

        $mpdf->Output($fileName, \Mpdf\Output\Destination::INLINE);
        exit;
    }

    /**
     * Returns the currently logged-in frontend user ID.
     */
    protected function getFrontendUserId(): int
    {
        return (int)($GLOBALS['TSFE']->fe_user->user['uid'] ?? 0);
    }

    /**
     * Checks access to a certificate by user session.
     *
     * @throws AccessDeniedException
     */
    protected function ensureAccess(UserCourseRecord $record): void
    {
        $userId = $this->getFrontendUserId();
        if ($record->getUser()?->getUid() !== $userId) {
            $this->logger->warning('Unauthorized certificate access attempt', [
                'recordId' => $record->getUid(),
                'userId' => $userId
            ]);
            throw new AccessDeniedException('Access denied to this certificate.');
        }
    }

    /**
     * Creates a temporary certificate if none exists.
     */
    protected function createPlaceholderCertificate(UserCourseRecord $record): Certificate
    {
        $certificate = new Certificate();
        $certificate->setCode($record->getCertificateCode());
        $certificate->setUserCourseRecord($record);
        $certificate->setIssuedAt($record->getCompletionDate());
        return $certificate;
    }

    /**
     * Renders the PDF HTML content.
     */
    protected function generatePdfHtml(Certificate $certificate, UserCourseRecord $record): string
    {
        // Replace with actual rendering logic, e.g. using FluidStandaloneView
        return '<h1>EquEd Certificate</h1><p>Code: ' . htmlspecialchars($certificate->getCode()) . '</p>';
    }
}
