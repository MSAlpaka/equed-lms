<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * QMS Case entity
 */
class QmsCase extends AbstractEntity
{
    private int $auditLogId;
    private string $status;
    private \DateTimeImmutable $createdAt;

    public function getAuditLogId(): int
    {
        return $this->auditLogId;
    }

    public function setAuditLogId(int $auditLogId): void
    {
        $this->auditLogId = $auditLogId;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
