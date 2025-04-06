<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Annotation\ORM as Extbase;

/**
 * This model logs significant user actions in the LMS for audit and QMS purposes.
 *
 * Examples:
 * - Course completion
 * - Exam attempt
 * - Certification issued
 * - QMS Incident created
 */
class AuditLog extends AbstractEntity
{
    /**
     * @var FrontendUser|null
     * @Extbase\Lazy
     */
    protected ?FrontendUser $feUser = null;

    /**
     * @var string
     */
    protected string $action = '';

    /**
     * @var int
     */
    protected int $relatedId = 0;

    /**
     * @var string
     */
    protected string $relatedType = '';

    /**
     * @var string
     */
    protected string $comment = '';

    /**
     * @var \DateTimeInterface|null
     */
    protected ?\DateTimeInterface $timestamp = null;

    /**
     * @var int
     */
    protected int $pid = 0;

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

    public function getTimestamp(): ?\DateTimeInterface
    {
        return $this->timestamp;
    }

    public function setTimestamp(?\DateTimeInterface $timestamp): void
    {
        $this->timestamp = $timestamp;
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
