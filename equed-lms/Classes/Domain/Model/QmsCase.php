<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use DateTimeInterface;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Annotation\ORM as Extbase;

/**
 * QMS Case entity – opened when an audit log entry leads to quality concerns.
 */
class QmsCase extends AbstractEntity
{
    /**
     * @Extbase\Lazy
     */
    protected ?AuditLog $auditLog = null;

    protected string $status = 'open'; // open, in_review, resolved, closed
    protected ?DateTimeInterface $createdAt = null;

    protected string $description = '';
    protected string $feedback = '';

    protected int $pid = 0;

    public function getAuditLog(): ?AuditLog
    {
        return $this->auditLog;
    }

    public function setAuditLog(?AuditLog $auditLog): void
    {
        $this->auditLog = $auditLog;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTimeInterface $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getFeedback(): string
    {
        return $this->feedback;
    }

    public function setFeedback(string $feedback): void
    {
        $this->feedback = $feedback;
    }

    public function getPid(): int
    {
        return $this->pid;
    }

    public function setPid(int $pid): void
    {
        $this->pid = $pid;
    }
}
