<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Fortschritt eines/einer Teilnehmenden in einer bestimmten Lektion.
 */
class UserLessonProgress extends AbstractEntity
{
    /**
     * @var FrontendUser|null
     */
    protected ?FrontendUser $feUser = null;

    /**
     * Zugeordnete Lektion
     *
     * @var Lesson|null
     */
    protected ?Lesson $lesson = null;

    /**
     * Wurde die Lektion als abgeschlossen bestätigt?
     *
     * @var bool
     */
    protected bool $confirmed = false;

    /**
     * Quiz-Ergebnis (z. B. Prozentzahl)
     *
     * @var float
     */
    protected float $quizScore = 0.0;

    /**
     * Wurde die Lektion abgeschlossen?
     *
     * @var bool
     */
    protected bool $completed = false;

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
}