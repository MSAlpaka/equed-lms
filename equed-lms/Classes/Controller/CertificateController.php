<?php

declare(strict_types=1);

namespace Equed\EquedLms\Controller;

use Equed\EquedLms\Domain\Model\Certificate;
use Equed\EquedLms\Domain\Model\UserCourseRecord;
use Equed\EquedLms\Domain\Repository\CertificateRepository;
use Equed\EquedLms\Domain\Repository\UserCourseRecordRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Mpdf\Mpdf;

/**
 * Controller for displaying and exporting certificates
 */
class CertificateController extends ActionController
{
    /**
     * @var UserCourseRecordRepository
     */
    protected UserCourseRecordRepository $recordRepository;

    /**
     * @var CertificateRepository
     */
    protected CertificateRepository $certificateRepository;

    public function __construct(
        UserCourseRecordRepository $recordRepository,
        CertificateRepository $certificateRepository
    ) {
        $this->recordRepository = $recordRepository;
        $this->certificateRepository = $certificateRepository;
    }

    /**
     * Displays the certificate card for a completed course
     *
     * @param UserCourseRecord $record
     */
    public function showCardAction(UserCourseRecord $record): void
    {
        $certificate = $this->certificateRepository->findByUserCourseRecord($record);

        if (!$certificate) {
            // Generate a placeholder certificate for preview
            $certificate = new Certificate();
            $certificate->setCode($record->getCertificateCode());
            $certificate->setUserCourseRecord($record);
            $certificate->setIssuedAt($record->getCompletionDate());
            $certificate->setIssuedBy($record->getInstructor());
        }

        $this->view->assignMultiple([
            'certificate' => $certificate,
            'record' => $record,
        ]);
    }

    /**
     * Generates and outputs the certificate as a downloadable PDF
     *
     * @param UserCourseRecord $record
     */
    public function downloadPdfAction(UserCourseRecord $record): void
    {
        $certificate = $this->certificateRepository->findByUserCourseRecord($record);

        if (!$certificate) {
            $certificate = new Certificate();
            $certificate->setCode($record->getCertificateCode());
            $certificate->setUserCourseRecord($record);
            $certificate->setIssuedAt($record->getCompletionDate());
            $certificate->setIssuedBy($record->getInstructor());
        }

        $html = $this->generatePdfHtml($certificate, $record);

        $mpdf = GeneralUtility::makeInstance(Mpdf::class);
        $mpdf->WriteHTML($html);

        $fileName = 'Certificate_' . $certificate->getCode() . '.pdf';

        // PDF direkt ausgeben
        $mpdf->Output($fileName, \Mpdf\Output\Destination::INLINE);
        exit;
    }

    /**
     * Generates HTML content for the PDF certificate
     *
     * @param Certificate $certificate
     * @param UserCourseRecord $record
     * @return string
     */
    protected function generatePdfHtml(Certificate $certificate, UserCourseRecord $record): string
    {
        // Hier kann später ein Fluid Template eingebunden werden – aktuell einfacher HTML-Stub
        return '
            <h1>Zertifikat</h1>
            <p><strong>Code:</strong> ' . htmlspecialchars((string)$certificate->getCode()) . '</p>
            <p><strong>Teilnehmer:</strong> ' . htmlspecialchars((string)$record->getUser()?->getFullName()) . '</p>
            <p><strong>Kurs:</strong> ' . htmlspecialchars((string)$record->getCourse()?->getTitle()) . '</p>
            <p><strong>Ausgestellt am:</strong> ' . $certificate->getIssuedAt()?->format('d.m.Y') . '</p>
        ';
    }
}