<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;

/**
 * Zeichnet wichtige Benutzeraktionen im LMS auf – für Nachvollziehbarkeit und QMS.
 *
 * Beispiele:
 * - Kursabschluss
 * - Prüfungsversuch
 * - Zertifikatserstellung
 * - QMS-Fall eröffnet
 */
class AuditLog extends AbstractEntity
{
    protected int $pid = 0;

    #[Lazy]
    protected ?FrontendUser $feUser = null;

    protected string $action = '';

    protected int $relatedId = 0;

    protected string $relatedType = '';

    protected string $comment = '';

    protected ?\DateTimeImmutable $timestamp = null;

    public function getPid(): int
    {
        return $this->pid;
    }

    public function setPid(int $pid): void
    {
        $this->pid = $pid;
    }

    public function getFeUser(): ?FrontendUser
    {
        return $this->feUser;
    }

    public function setFeUser(?FrontendUser $feUser): void
    {
        $this->feUser = $feUser;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function setAction(string $action): void
    {
        $this->action = $action;
    }

    public function getRelatedId(): int
    {
        return $this->relatedId;
    }

    public function setRelatedId(int $relatedId): void
    {
        $this->relatedId = $relatedId;
    }

    public function getRelatedType(): string
    {
        return $this->relatedType;
    }

    public function setRelatedType(string $relatedType): void
    {
        $this->relatedType = $relatedType;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

    public function getTimestamp(): ?\DateTimeImmutable
    {
        return $this->timestamp;
    }

    public function setTimestamp(?\DateTimeImmutable $timestamp): void
    {
        $this->timestamp = $timestamp;
    }
}