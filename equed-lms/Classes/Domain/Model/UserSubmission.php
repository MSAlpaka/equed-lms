<?php

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use DateTime;

class UserSubmission extends AbstractEntity
{
    protected int $feUser = 0;
    protected ?Course $course = null;
    protected string $type = '';
    protected string $status = 'submitted';
    protected ?FileReference $document = null;
    protected string $comment = '';
    protected string $grade = '';
    protected ?DateTime $submittedAt = null;

    public function getFeUser(): int
    {
        return $this->feUser;
    }

    public function setFeUser(int $feUser): void
    {
        $this->feUser = $feUser;
    }

    public function getCourse(): ?Course
    {
        return $this->course;
    }

    public function setCourse(?Course $course): void
    {
        $this->course = $course;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getDocument(): ?FileReference
    {
        return $this->document;
    }

    public function setDocument(?FileReference $document): void
    {
        $this->document = $document;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

    public function getGrade(): string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): void
    {
        $this->grade = $grade;
    }

    public function getSubmittedAt(): ?DateTime
    {
        return $this->submittedAt;
    }

    public function setSubmittedAt(?DateTime $submittedAt): void
    {
        $this->submittedAt = $submittedAt;
    }
}