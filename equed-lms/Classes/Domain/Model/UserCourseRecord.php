<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;

/**
 * UserCourseRecord
 */
class UserCourseRecord extends AbstractEntity
{
    /**
     * @var int
     */
    protected int $pid = 0;

    /**
     * @var CourseInstance
     * @Lazy
     */
    protected CourseInstance $courseInstance;

    /**
     * @var FrontendUser
     * @Lazy
     */
    protected FrontendUser $user;

    /**
     * @var FrontendUser|null
     * @Lazy
     */
    protected ?FrontendUser $instructor = null;

    /**
     * @var \DateTime|null
     */
    protected ?\DateTime $startedAt = null;

    /**
     * @var \DateTime|null
     */
    protected ?\DateTime $completedAt = null;

    /**
     * @var bool
     */
    protected bool $instructorConfirmed = false;

    /**
     * @var bool
     */
    protected bool $certifierValidated = false;

    /**
     * @var bool
     */
    protected bool $adminApproved = false;

    /**
     * @var string
     */
    protected string $certificateCode = '';

    /**
     * @var \DateTime|null
     */
    protected ?\DateTime $certificateIssuedAt = null;

    /**
     * @var string
     */
    protected string $status = 'in_progress';

    /**
     * @var string
     */
    protected string $metaJson = '';

    // --- Getter & Setter ---

    public function getPid(): int
    {
        return $this->pid;
    }

    public function setPid(int $pid): void
    {
        $this->pid = $pid;
    }

    public function getCourseInstance(): CourseInstance
    {
        return $this->courseInstance;
    }

    public function setCourseInstance(CourseInstance $courseInstance): void
    {
        $this->courseInstance = $courseInstance;
    }

    public function getUser(): FrontendUser
    {
        return $this->user;
    }

    public function setUser(FrontendUser $user): void
    {
        $this->user = $user;
    }

    public function getInstructor(): ?FrontendUser
    {
        return $this->instructor;
    }

    public function setInstructor(?FrontendUser $instructor): void
    {
        $this->instructor = $instructor;
    }

    public function getStartedAt(): ?\DateTime
    {
        return $this->startedAt;
    }

    public function setStartedAt(?\DateTime $startedAt): void
    {
        $this->startedAt = $startedAt;
    }

    public function getCompletedAt(): ?\DateTime
    {
        return $this->completedAt;
    }

    public function setCompletedAt(?\DateTime $completedAt): void
    {
        $this->completedAt = $completedAt;
    }

    public function isInstructorConfirmed(): bool
    {
        return $this->instructorConfirmed;
    }

    public function setInstructorConfirmed(bool $confirmed): void
    {
        $this->instructorConfirmed = $confirmed;
    }

    public function isCertifierValidated(): bool
    {
        return $this->certifierValidated;
    }

    public function setCertifierValidated(bool $validated): void
    {
        $this->certifierValidated = $validated;
    }

    public function isAdminApproved(): bool
    {
        return $this->adminApproved;
    }

    public function setAdminApproved(bool $approved): void
    {
        $this->adminApproved = $approved;
    }

    public function getCertificateCode(): string
    {
        return $this->certificateCode;
    }

    public function setCertificateCode(string $code): void
    {
        $this->certificateCode = $code;
    }

    public function getCertificateIssuedAt(): ?\DateTime
    {
        return $this->certificateIssuedAt;
    }

    public function setCertificateIssuedAt(?\DateTime $issuedAt): void
    {
        $this->certificateIssuedAt = $issuedAt;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getMetaJson(): string
    {
        return $this->metaJson;
    }

    public function setMetaJson(string $meta): void
    {
        $this->metaJson = $meta;
    }
}
