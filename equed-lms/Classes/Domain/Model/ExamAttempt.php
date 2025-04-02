<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class ExamAttempt extends AbstractEntity
{
    protected ?UserCourseRecord $record = null;

    protected string $type = ''; // 'theory', 'practical', 'case'

    protected bool $passed = false;

    protected string $feedback = '';

    protected ?\DateTime $attemptDate = null;

    protected ?User $instructor = null;

    public function getRecord(): ?UserCourseRecord
    {
        return $this->record;
    }

    public function setRecord(?UserCourseRecord $record): void
    {
        $this->record = $record;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function isPassed(): bool
    {
        return $this->passed;
    }

    public function setPassed(bool $passed): void
    {
        $this->passed = $passed;
    }

    public function getFeedback(): string
    {
        return $this->feedback;
    }

    public function setFeedback(string $feedback): void
    {
        $this->feedback = $feedback;
    }

    public function getAttemptDate(): ?\DateTime
    {
        return $this->attemptDate;
    }

    public function setAttemptDate(?\DateTime $attemptDate): void
    {
        $this->attemptDate = $attemptDate;
    }

    public function getInstructor(): ?User
    {
        return $this->instructor;
    }

    public function setInstructor(?User $instructor): void
    {
        $this->instructor = $instructor;
    }
}