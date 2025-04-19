<?php
declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use Equed\EquedLms\Domain\Model\CourseInstance;
use Equed\EquedLms\Domain\Model\FrontendUser;

class UserCourseRecord extends AbstractEntity
{
    /**
     * @var FrontendUser|null
     */
    protected ?FrontendUser $user = null;

    /**
     * @var CourseInstance|null
     */
    protected ?CourseInstance $courseInstance = null;

    /**
     * @var string
     */
    protected string $status = 'registered'; // Werte: registered, in_progress, submitted, passed, failed, validated

    /**
     * @var bool
     */
    protected bool $isRepeat = false;

    /**
     * @var string
     */
    protected string $feedbackNote = '';

    /**
     * @var string
     */
    protected string $internalNote = '';

    /**
     * @var bool
     */
    protected bool $instructorConfirmed = false;

    /**
     * @var bool
     */
    protected bool $certifierValidated = false;

    /**
     * @var string
     */
    protected string $uuid = '';

    /**
     * @var \DateTime|null
     */
    protected ?\DateTime $createdAt = null;

    /**
     * @var \DateTime|null
     */
    protected ?\DateTime $updatedAt = null;

    public function getUser(): ?FrontendUser
    {
        return $this->user;
    }

    public function setUser(?FrontendUser $user): void
    {
        $this->user = $user;
    }

    public function getCourseInstance(): ?CourseInstance
    {
        return $this->courseInstance;
    }

    public function setCourseInstance(?CourseInstance $courseInstance): void
    {
        $this->courseInstance = $courseInstance;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function isRepeat(): bool
    {
        return $this->isRepeat;
    }

    public function setIsRepeat(bool $isRepeat): void
    {
        $this->isRepeat = $isRepeat;
    }

    public function getFeedbackNote(): string
    {
        return $this->feedbackNote;
    }

    public function setFeedbackNote(string $feedbackNote): void
    {
        $this->feedbackNote = $feedbackNote;
    }

    public function getInternalNote(): string
    {
        return $this->internalNote;
    }

    public function setInternalNote(string $internalNote): void
    {
        $this->internalNote = $internalNote;
    }

    public function isInstructorConfirmed(): bool
    {
        return $this->instructorConfirmed;
    }

    public function setInstructorConfirmed(bool $instructorConfirmed): void
    {
        $this->instructorConfirmed = $instructorConfirmed;
    }

    public function isCertifierValidated(): bool
    {
        return $this->certifierValidated;
    }

    public function setCertifierValidated(bool $certifierValidated): void
    {
        $this->certifierValidated = $certifierValidated;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}

