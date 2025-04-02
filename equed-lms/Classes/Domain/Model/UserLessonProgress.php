<?php

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class UserLessonProgress extends AbstractEntity
{
    protected int $feUser = 0;
    protected bool $confirmed = false;
    protected float $quizScore = 0.0;
    protected bool $completed = false;

    // NEU
    protected ?Lesson $lesson = null;

    public function getFeUser(): int
    {
        return $this->feUser;
    }

    public function setFeUser(int $feUser): void
    {
        $this->feUser = $feUser;
    }

    public function isConfirmed(): bool
    {
        return $this->confirmed;
    }

    public function setConfirmed(bool $confirmed): void
    {
        $this->confirmed = $confirmed;
    }

    public function getQuizScore(): float
    {
        return $this->quizScore;
    }

    public function setQuizScore(float $quizScore): void
    {
        $this->quizScore = $quizScore;
    }

    public function isCompleted(): bool
    {
        return $this->completed;
    }

    public function setCompleted(bool $completed): void
    {
        $this->completed = $completed;
    }

    public function getLesson(): ?Lesson
    {
        return $this->lesson;
    }

    public function setLesson(?Lesson $lesson): void
    {
        $this->lesson = $lesson;
    }
}