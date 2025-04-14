<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;

/**
 * Lernfortschritt eines Teilnehmenden in einer bestimmten Lektion.
 *
 * Speichert Start-, Abschlusszeitpunkt, Quiz-Ergebnisse, Dauer und Fortschrittsstatus.
 */
class UserLessonProgress extends AbstractEntity
{
    protected int $pid = 0;

    #[Lazy]
    protected ?FrontendUser $feUser = null;

    #[Lazy]
    protected ?Lesson $lesson = null;

    protected bool $confirmed = false;

    protected float $quizScore = 0.0;

    protected bool $completed = false;

    protected float $progressPercent = 0.0;

    protected ?\DateTimeImmutable $startedAt = null;

    protected ?\DateTimeImmutable $completedAt = null;

    protected ?\DateTimeImmutable $lastVisitedAt = null;

    protected int $duration = 0;

    protected string $note = '';

    public function getPid(): int
    {
        return $this->pid;
    }

    public function setPid(int $pid): void
    {
        $this->pid = $pid;
    }

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
        this->completed = $completed;
    }

    public function getProgressPercent(): float
    {
        return $this->progressPercent;
    }

    public function setProgressPercent(float $progressPercent): void
    {
        $this->progressPercent = $progressPercent;
    }

    public function getStartedAt(): ?\DateTimeImmutable
    {
        return $this->startedAt;
    }

    public function setStartedAt(?\DateTimeImmutable $startedAt): void
    {
        $this->startedAt = $startedAt;
    }

    public function getCompletedAt(): ?\DateTimeImmutable
    {
        return $this->completedAt;
    }

    public function setCompletedAt(?\DateTimeImmutable $completedAt): void
    {
        $this->completedAt = $completedAt;
    }

    public function getLastVisitedAt(): ?\DateTimeImmutable
    {
        return $this->lastVisitedAt;
    }

    public function setLastVisitedAt(?\DateTimeImmutable $lastVisitedAt): void
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

    public function hasNote(): bool
    {
        return trim($this->note) !== '';
    }
}