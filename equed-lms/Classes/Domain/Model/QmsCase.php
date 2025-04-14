<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;

/**
 * QMS-Fall: Wird geöffnet, wenn ein Audit-Vorgang zur Qualitätsprüfung führt.
 *
 * Dokumentiert Beschreibung, Status, Feedback und Verknüpfung zum Audit-Eintrag.
 */
class QmsCase extends AbstractEntity
{
    protected int $pid = 0;

    #[Lazy]
    protected ?AuditLog $auditLog = null;

    /**
     * Mögliche Werte: open, in_review, resolved, closed
     */
    protected string $status = 'open';

    protected ?\DateTimeImmutable $createdAt = null;

    protected string $description = '';

    protected string $feedback = '';

    public function getPid(): int
    {
        return $this->pid;
    }

    public function setPid(int $pid): void
    {
        $this->pid = $pid;
    }

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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): void
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
}