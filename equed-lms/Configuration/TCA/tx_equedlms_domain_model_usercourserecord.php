<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class UserCourseRecord extends AbstractEntity
{
    protected int $user = 0;
    protected int $course = 0;

    protected bool $completed = false;
    protected bool $validated = false;
    protected string $certificateCode = '';
    protected \DateTimeInterface $completionDate;

    // 🆕 NEU: Instructor-Zuweisung & Matching-Infos
    protected string $participantPostalCode = '';
    protected string $matchingStatus = 'pending'; // pending, auto_assigned, manually_assigned, declined

    /** @var \Equed\EquedLms\Domain\Model\Instructor|null */
    protected $assignedInstructor;

    public function getUser(): int
    {
        return $this->user;
    }

    public function setUser(int $user): void
    {
        $this->user = $user;
    }

    public function getCourse(): int
    {
        return $this->course;
    }

    public function setCourse(int $course): void
    {
        $this->course = $course;
    }

    public function isCompleted(): bool
    {
        return $this->completed;
    }

    public function setCompleted(bool $completed): void
    {
        $this->completed = $completed;
    }

    public function isValidated(): bool
    {
        return $this->validated;
    }

    public function setValidated(bool $validated): void
    {
        $this->validated = $validated;
    }

    public function getCertificateCode(): string
    {
        return $this->certificateCode;
    }

    public function setCertificateCode(string $certificateCode): void
    {
        $this->certificateCode = $certificateCode;
    }

    public function getCompletionDate(): \DateTimeInterface
    {
        return $this->completionDate;
    }

    public function setCompletionDate(\DateTimeInterface $completionDate): void
    {
        $this->completionDate = $completionDate;
    }

    public function getParticipantPostalCode(): string
    {
        return $this->participantPostalCode;
    }

    public function setParticipantPostalCode(string $postalCode): void
    {
        $this->participantPostalCode = $postalCode;
    }

    public function getMatchingStatus(): string
    {
        return $this->matchingStatus;
    }

    public function setMatchingStatus(string $status): void
    {
        $this->matchingStatus = $status;
    }

    public function getAssignedInstructor(): ?\Equed\EquedLms\Domain\Model\Instructor
    {
        return $this->assignedInstructor;
    }

    public function setAssignedInstructor(?\Equed\EquedLms\Domain\Model\Instructor $instructor): void
    {
        $this->assignedInstructor = $instructor;
    }
}