<?php

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use DateTime;

class AuditLog extends AbstractEntity
{
    protected int $feUser = 0;
    protected string $action = '';
    protected int $relatedId = 0;
    protected string $relatedType = '';
    protected ?DateTime $timestamp = null;
    protected string $comment = '';

    public function getFeUser(): int
    {
        return $this->feUser;
    }

    public function setFeUser(int $feUser): void
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

    public function getTimestamp(): ?DateTime
    {
        return $this->timestamp;
    }

    public function setTimestamp(?DateTime $timestamp): void
    {
        $this->timestamp = $timestamp;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }
}