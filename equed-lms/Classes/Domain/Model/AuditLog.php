<?php

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;

/**
 * Logs significant user actions in the LMS.
 */
class AuditLog extends AbstractEntity
{
    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser|null
     */
    protected ?FrontendUser $feUser = null;

    protected string $action = '';

    protected int $relatedId = 0;

    protected string $relatedType = '';

    protected string $comment = '';

    protected ?\DateTime $timestamp = null;

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

    public function getTimestamp(): ?\DateTime
    {
        return $this->timestamp;
    }

    public function setTimestamp(?\DateTime $timestamp): void
    {
        $this->timestamp = $timestamp;
    }
}