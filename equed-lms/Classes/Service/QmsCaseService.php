<?php

declare(strict_types=1);

namespace Equed\EquedLms\Service;

use Equed\EquedLms\Domain\Model\QmsCase;
use Equed\EquedLms\Domain\Repository\AuditLogRepository;
use Equed\EquedLms\Domain\Repository\QmsCaseRepository;
use Psr\Log\LoggerInterface;

/**
 * Service to manage QMS case creation and escalation
 */
class QmsCaseService
{
    public function __construct(
        private readonly AuditLogRepository $auditLogRepository,
        private readonly QmsCaseRepository $qmsCaseRepository,
        private readonly LoggerInterface $logger
    ) {}

    /**
     * Create a new QMS case based on audit log entry
     *
     * @param int $auditLogId
     */
    public function createQmsCase(int $auditLogId): void
    {
        $auditLog = $this->auditLogRepository->findByUid($auditLogId);

        if ($auditLog === null) {
            $this->logger->warning('AuditLog entry not found for QMS case', [
                'auditLogId' => $auditLogId,
            ]);
            return;
        }

        // Create QMS case in the database
        $qmsCase = new QmsCase();
        $qmsCase->setAuditLog($auditLog);
        $qmsCase->setStatus('open');
        $qmsCase->setCreatedAt(new \DateTimeImmutable());

        // Persist QMS case
        $this->qmsCaseRepository->add($qmsCase);

        // Log the creation of the case
        $this->logger->info('QMS case created based on audit log', [
            'auditLogId' => $auditLogId,
            'action' => $auditLog->getAction(),
            'user' => $auditLog->getFeUser()?->getUid(),
            'qmsCaseId' => $qmsCase->getId(),
        ]);

        // TODO: Notify ServiceCenter or relevant parties
        // You may dispatch an event or send a notification email to ServiceCenter
    }
}