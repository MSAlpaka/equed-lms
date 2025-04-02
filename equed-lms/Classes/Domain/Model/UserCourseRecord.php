<?php

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;

/**
 * Represents the participation of a user in a course,
 * including progress, validation and certification.
 */
class UserCourseRecord extends AbstractEntity
{
    /**
     * @var \Equed\EquedLms\Domain\Model\Course
     */
    protected Course $course;

    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
     */
    protected FrontendUser $user;

    /**
     * @var string 'in_progress', 'completed', 'validated', 'rejected'
     */
    protected string $status = 'in_progress';

    /**
     * @var \DateTime|null
     */
    protected ?\DateTime $completionDate = null;

    /**
     * @var bool
     */
    protected bool $validated = false;

    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser|null
     */
    protected ?FrontendUser $certifier = null;

    public function getCourse(): Course
    {
        return $this->course;
    }

    public function setCourse(Course $course): void
    {
        $this->course = $course;
    }

    public function getUser(): FrontendUser
    {
        return $this->user;
    }

    public function setUser(FrontendUser $user): void
    {
        $this->user = $user;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getCompletionDate(): ?\DateTime
    {
        return $this->completionDate;
    }

    public function setCompletionDate(?\DateTime $completionDate): void
    {
        $this->completionDate = $completionDate;
    }

    public function isValidated(): bool
    {
        return $this->validated;
    }

    public function setValidated(bool $validated): void
    {
        $this->validated = $validated;
    }

    public function getCertifier(): ?FrontendUser
    {
        return $this->certifier;
    }

    public function setCertifier(?FrontendUser $certifier): void
    {
        $this->certifier = $certifier;
    }
}