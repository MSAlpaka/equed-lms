<?php

declare(strict_types=1);

namespace Equed\EquedLms\Controller;

use Equed\EquedLms\Domain\Model\UserCourseRecord;
use Equed\EquedLms\Service\QrCodeService;
use Equed\EquedLms\Domain\Repository\UserCourseRecordRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use TYPO3\CMS\Core\Http\Response;
use TYPO3\CMS\Core\Http\Stream;
use TYPO3\CMS\Core\Exception\AccessDeniedException;
use Mpdf\Mpdf;

class CertificateController extends ActionController
{
    protected UserCourseRecordRepository $recordRepository;

    public function __construct(UserCourseRecordRepository $recordRepository)
    {
        $this->recordRepository = $recordRepository;
    }

    /**
     * Anzeige der Zertifikatsdetails (Karte)
     */
    public function showCardAction(UserCourseRecord $record): void
    {
        $user = $record->getUser();
        $course = $record->getCourse();
        $certifier = $record->getValidatedBy();
        $center = $record->getCenter();
        $certificateCode = $record->getCertificateCode();

        /** @var QrCodeService $qrCodeService */
        $qrCodeService = GeneralUtility::makeInstance(QrCodeService::class);
        $qrImagePath = $qrCodeService->generateAndStoreQrCode($certificateCode);

        $this->view->assignMultiple([
            'user' => [
                'fullName' => $user->getFullName(),
                'photo' => $user->getPhoto()?->getOriginalResource()?->getPublicUrl() ?? '',
            ],
            'course' => [
                'title' => $course->getTitle(),
                'date' => $record->getCompletionDate()?->format('Y-m-d'),
            ],
            'certifier' => [
                'name' => $certifier?->getFullName() ?? '',
            ],
            'center' => [
                'name' => $center?->getName() ?? '',
            ],
            'certificate' => [
                'code' => $certificateCode,
                'qr' => $qrImagePath, // QR-Code-Pfad hinzufügen
            ],
        ]);
    }

    /**
     * Zertifikats-Download als PDF
     */
    public function downloadAction(string $certificateCode = ''): Response
    {
        // Zertifikat anhand des Codes suchen
        $record = $this->recordRepository->findOneByCertificateCode($certificateCode);

        if (!$record || !$record->isCompleted() || !$record->isValidated()) {
            throw new AccessDeniedException('Certificate not found or not valid.', 1648123450);
        }

        // Übergabe der Daten an die View
        $qrCodePath = $record->getQrCodePath(); // QR-Code-Pfad
        $this->view->assignMultiple([
            'record' => $record,
            'user' => $record->getUser(),
            'course' => $record->getCourse(),
            'center' => $record->getCenter(),
            'certifier' => $record->getValidatedBy(),
            'certificate' => [
                'code' => $certificateCode,
                'qr'   => $qrCodePath,
            ],
        ]);

        // Zertifikat als HTML rendern
        $html = $this->view->render();

        // PDF mit mPDF erstellen
        $mpdf = new Mpdf(['format' => 'A4', 'utf-8' => true]);
        $mpdf->WriteHTML($html);
        $pdfContent = $mpdf->Output('', 'S'); // PDF als String

        // PDF als Stream zurückgeben
        $stream = GeneralUtility::makeInstance(Stream::class, 'php://temp', 'w+');
        $stream->write($pdfContent);
        $stream->rewind();

        // Dateiname für den Download
        $filename = 'Certificate_' . $certificateCode . '.pdf';

        return (new Response())
            ->withHeader('Content-Type', 'application/pdf')
            ->withHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->withBody($stream);
    }

    /**
     * Initialisierung der View mit dem Template
     */
    protected function initializeView(ViewInterface $view): void
    {
        $templatePath = GeneralUtility::getFileAbsFileName('EXT:equed_lms/Resources/Private/Templates/Certificate/Card.html');

        if (!file_exists($templatePath)) {
            throw new \RuntimeException('Certificate template not found: ' . $templatePath, 1648123451);
        }

        $view->setTemplatePathAndFilename($templatePath);
    }
}