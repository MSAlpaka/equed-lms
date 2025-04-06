<?php

declare(strict_types=1);

namespace Equed\EquedLms\Controller;

use Equed\EquedLms\Domain\Model\Certificate;
use Equed\EquedLms\Domain\Model\UserCourseRecord;
use Equed\EquedLms\Domain\Repository\CertificateRepository;
use Equed\EquedLms\Domain\Repository\UserCourseRecordRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Authentication\FrontendUserAuthentication;
use TYPO3\CMS\Core\Exception\AccessDeniedException;
use Psr\Log\LoggerInterface;
use Mpdf\Mpdf;

class CertificateController extends ActionController
{
    public function __construct(
        protected readonly UserCourseRecordRepository $recordRepository,
        protected readonly CertificateRepository $certificateRepository,
        protected readonly LoggerInterface $logger
    ) {}

    /**
     * Zeigt eine Zertifikatsvorschau an.
     *
     * @throws AccessDeniedException
     */
    public function showCardAction(UserCourseRecord $record): void
    {
        $this->ensureAccess($record);

        $certificate = $this->certificateRepository->findByUserCourseRecord($record)
            ?? $this->createPlaceholderCertificate($record);

        $this->logger->info('Certificate preview shown', [
            'recordId' => $record->getUid(),
            'userId' => $GLOBALS['TSFE']->fe_user->user['uid'] ?? null,
        ]);

        $this->view->assignMultiple([
            'certificate' => $certificate,
            'record' => $record,
        ]);
    }

    /**
     * Erstellt ein PDF-Zertifikat und gibt es direkt aus.
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

        $this->logger->info('Certificate PDF downloaded', [
            'recordId' => $record->getUid(),
            'code' => $certificate->getCode(),
            'userId' => $GLOBALS['TSFE']->fe_user->user['uid'] ?? null,
        ]);

        // PDF direkt ausgeben und Script beenden
        $mpdf->Output($fileName, \Mpdf\Output\Destination::INLINE);
        exit; // intentional: stop script after direct output
    }

    /**
     * Erstellt ein temporäres Platzhalter-Zertifikat.
     */
    protected function createPlaceholderCertificate(UserCourseRecord $record): Certificate
    {
        $certificate = new Certificate();
        $certificate->setCode($record->getCertificateCode());
        $certificate->setUserCourseRecord($record);
        $certificate->setIssuedAt($record->getCompletionDate());
        $certificate->setIssuedBy($record->getInstructor());
        return $certificate;
    }

    /**
     * Zugriffsschutz: Nur Teilnehmende oder zugewiesene Instructoren dürfen das Zertifikat sehen.
     *
     * @throws AccessDeniedException
     */
    protected function ensureAccess(UserCourseRecord $record): void
    {
        $feUser = $this->getFrontendUser();
        $userId = $feUser?->user['uid'] ?? null;

        $isOwner = $record->getFrontendUser()?->getUid() === $userId;
        $isInstructor = $record->getInstructor()?->getUid() === $userId;

        if (!$isOwner && !$isInstructor) {
            throw new AccessDeniedException('Kein Zugriff auf dieses Zertifikat.');
        }
    }

    protected function getFrontendUser(): ?FrontendUserAuthentication
    {
        return $GLOBALS['TSFE']->fe_user ?? null;
    }

    /**
     * Baut den HTML-Inhalt für das PDF-Zertifikat.
     */
    protected function generatePdfHtml(Certificate $certificate, UserCourseRecord $record): string
    {
        return '
            <html><body style="text-align:center;">
                <h1>Certificate of Completion</h1>
                <p>This certifies that <strong>' . htmlspecialchars($record->getFrontendUser()?->getFullName() ?? '') . '</strong></p>
                <p>has successfully completed the course</p>
                <h2>' . htmlspecialchars($record->getCourseInstance()?->getTitle() ?? '') . '</h2>
                <p>Issued on: ' . $certificate->getIssuedAt()?->format('Y-m-d') . '</p>
                <p>Certificate Code: ' . $certificate->getCode() . '</p>
            </body></html>
        ';
    }
}