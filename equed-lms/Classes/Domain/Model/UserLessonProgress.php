<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Represents the progress of a user in a specific lesson.
 *
 * Tracks quiz result, status, timestamps and time spent.
 */
class UserLessonProgress extends AbstractEntity
{
    protected ?FrontendUser $feUser = null;

    protected ?Lesson $lesson = null;

    protected bool $confirmed = false;

    protected float $quizScore = 0.0;

    protected bool $completed = false;

    /**
     * Optional: progress in percent (0–100)
     */
    protected float $progressPercent = 0.0;

    /**
     * Timestamp of lesson start
     */
    protected ?\DateTime $startedAt = null;

    /**
     * Timestamp of lesson completion
     */
    protected ?\DateTime $completedAt = null;

    /**
     * Timestamp of last interaction with the lesson
     */
    protected ?\DateTime $lastVisitedAt = null;

    /**
     * Total time spent in minutes
     */
    protected int $duration = 0;

    /**
     * Optional learner note (e.g. private reflection or question)
     */
    protected string $note = '';

    public function getFeUser(): ?FrontendUser
    {
        return $this->feUser;
    }

    public function setFeUser(?FrontendUser $feUser): void
    {
        $this->feUser = $feUser;
    }

    public function getLesson(): ?Lesson
    {
        return $this->lesson;
    }

    public function setLesson(?Lesson $lesson): void
    {
        $this->lesson = $lesson;
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

    public function getProgressPercent(): float
    {
        return $this->progressPercent;
    }

    public function setProgressPercent(float $progressPercent): void
    {
        $this->progressPercent = $progressPercent;
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

    public function getLastVisitedAt(): ?\DateTime
    {
        return $this->lastVisitedAt;
    }

    public function setLastVisitedAt(?\DateTime $lastVisitedAt): void
    {
        $this->lastVisitedAt = $lastVisitedAt;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): void
    {
        $this->duration = $duration;
    }

    public function getNote(): string
    {
        return $this->note;
    }

    public function setNote(string $note): void
    {
        $this->note = $note;
    }
}