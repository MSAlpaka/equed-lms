<?php
namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use DateTime;

class UserLessonProgress extends AbstractEntity
{
    protected int $feUser = 0;

    protected ?Lesson $lesson = null;
    protected bool $confirmed = false;
    protected int $quizScore = 0;
    protected bool $completed = false;
    protected ?DateTime $completedAt = null;

    public function getFeUser(): int
    {
        return $this->feUser;
    }

    public function setFeUser(int $feUser): void
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

    public function getQuizScore(): int
    {
        return $this->quizScore;
    }

    public function setQuizScore(int $quizScore): void
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

    public function getCompletedAt(): ?DateTime
    {
        return $this->completedAt;
    }

    public function setCompletedAt(?DateTime $completedAt): void
    {
        $this->completedAt = $completedAt;
    }
}