<?php

declare(strict_types=1);

namespace Equed\EquedLms\Service;

use Mpdf\Mpdf;
use Mpdf\Output\Destination;
use Psr\Log\LoggerInterface;
use Symfony\Component\Mailer\MailerInterface;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Localization\LanguageService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\EventDispatcher\EventDispatcherInterface;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Equed\EquedLms\Domain\Model\UserCourseRecord;
use Equed\EquedLms\Domain\Repository\UserCourseRecordRepository;
use Equed\EquedLms\Event\CertificateIssuedEvent;

class CertificateService
{
    private string $certificateDir;

    public function __construct(
        private readonly MailerInterface $mailer,
        private readonly LoggerInterface $logger,
        private readonly EventDispatcherInterface $eventDispatcher,
        private readonly UserCourseRecordRepository $userCourseRecordRepository
    ) {
        $this->certificateDir = Environment::getPublicPath() . '/fileadmin/user_upload/certificates/';
        if (!is_dir($this->certificateDir)) {
            @mkdir($this->certificateDir, 0775, true);
        }
    }

    public function generateCertificate(UserCourseRecord $record): string
    {
        $userId = $record->getUser()->getUid();
        $courseId = $record->getCourseInstance()->getUid();

        $code = sprintf('EQD-%06d-%06d-%s', $userId, $courseId, date('Ymd'));
        $fileName = sprintf('%s.pdf', $code);
        $filePath = $this->certificateDir . $fileName;

        try {
            // PDF erzeugen
            $mpdf = new Mpdf();

            $courseTitle = $record->getCourseInstance()->getProgram()->getTitle();
            $userName = $record->getUser()->getName() ?? 'Teilnehmende*r';

            $title = $this->translate('pdf.title');
            $text = str_replace(
                ['{user}', '{course}', '{code}'],
                [$userName, $courseTitle, $code],
                $this->translate('pdf.text')
            );

            $html = '<h1>' . $title . '</h1><p>' . nl2br($text) . '</p>';
            $mpdf->WriteHTML($html);
            $mpdf->Output($filePath, Destination::FILE);

            // Werte in Record speichern
            $record->setCertificateCode($code);
            $record->setCertificateIssuedAt(new \DateTimeImmutable());

            // Persistieren
            $this->userCourseRecordRepository->update($record);

            // Event auslösen
            $this->eventDispatcher->dispatch(
                new CertificateIssuedEvent($record, $filePath, $code)
            );

            return $filePath;

        } catch (\Throwable $e) {
            $this->logger->error('Certificate generation failed: ' . $e->getMessage());
            return '';
        }
    }

    private function translate(string $key, array $arguments = [], string $languageKey = null): string
    {
        return LocalizationUtility::translate($key, 'equed_lms', $arguments, $languageKey)
            ?? '[[' . $key . ']]';
    }
}