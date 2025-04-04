<?php

declare(strict_types=1);

namespace Equed\EquedLms\Service;

use DateTimeImmutable;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;
use Psr\Log\LoggerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\EventDispatcher\EventDispatcherInterface;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Equed\EquedLms\Event\CertificateIssuedEvent;

class CertificateService
{
    private string $certificateDir;

    public function __construct(
        private readonly MailerInterface $mailer,
        private readonly LoggerInterface $logger,
        private readonly EventDispatcherInterface $eventDispatcher
    ) {
        $this->certificateDir = Environment::getPublicPath() . '/fileadmin/user_upload/certificates/';
        if (!is_dir($this->certificateDir)) {
            @mkdir($this->certificateDir, 0775, true);
        }
    }

    public function generateCertificate(int $userId, int $courseId): string
    {
        $fileName = sprintf('certificate_%d_%d.pdf', $userId, $courseId);
        $filePath = $this->certificateDir . $fileName;

        try {
            $mpdf = new Mpdf();

            $title = $this->translate('pdf.title');
            $text = str_replace(
                ['{userId}', '{courseId}'],
                [(string)$userId, (string)$courseId],
                $this->translate('pdf.text')
            );

            $html = '<h1>' . $title . '</h1><p>' . $text . '</p>';
            $mpdf->WriteHTML($html);
            $mpdf->Output($filePath, Destination::FILE);

            $this->saveCertificateStatus($userId, $courseId, $filePath);

            return $filePath;
        } catch (\Throwable $e) {
            $this->logger->error('Certificate generation failed', [
                'exception' => $e,
                'userId' => $userId,
                'courseId' => $courseId,
            ]);
            throw new \RuntimeException('Certificate could not be generated.');
        }
    }

    public function sendCertificate(int $userId, int $courseId, string $email): bool
    {
        try {
            $pdfPath = $this->generateCertificate($userId, $courseId);

            $subject = str_replace('{courseId}', (string)$courseId, $this->translate('email.subject'));
            $body = $this->translate('email.body');

            $mail = (new Email())
                ->from('certificates@equed.eu')
                ->to($email)
                ->subject($subject)
                ->text($body)
                ->attachFromPath($pdfPath, basename($pdfPath), 'application/pdf');

            $this->mailer->send($mail);

            $this->eventDispatcher->dispatch(
                new CertificateIssuedEvent($userId, $courseId, $pdfPath)
            );

            return true;
        } catch (\Throwable $e) {
            $this->logger->error('Certificate sending failed', [
                'exception' => $e,
                'userId' => $userId,
                'courseId' => $courseId,
            ]);
            return false;
        }
    }

    private function saveCertificateStatus(int $userId, int $courseId, string $pdfPath): void
    {
        $status = [
            'userId' => $userId,
            'courseId' => $courseId,
            'file' => basename($pdfPath),
            'timestamp' => (new DateTimeImmutable())->format(DATE_ATOM),
        ];

        $statusFile = $this->certificateDir . 'status_' . $userId . '_' . $courseId . '.json';
        file_put_contents($statusFile, json_encode($status, JSON_PRETTY_PRINT));
    }

    private function translate(string $key): string
    {
        return LocalizationUtility::translate($key, 'equed_lms') ?? '[LL missing] ' . $key;
    }
}