<?php

declare(strict_types=1);

namespace Equed\EquedLms\EventListener;

use Equed\EquedLms\Event\CertificateIssuedEvent;
use Psr\Log\LoggerInterface;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

final class CertificateIssuedListener
{
    public function __construct(
        private readonly LoggerInterface $logger
    ) {}

    public function __invoke(CertificateIssuedEvent $event): void
    {
        $logMsg = LocalizationUtility::translate('log.certificate_sent', 'equed_lms') ?? 'Certificate sent';
        $this->logger->info($logMsg, [
            'userId' => $event->userId,
            'courseId' => $event->courseId,
            'file' => $event->pdfPath,
        ]);
    }
}