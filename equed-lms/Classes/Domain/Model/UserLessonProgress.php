<?php

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use Equed\EquedLms\Domain\Model\Lesson;

/**
 * Tracks a user's progress through lessons.
 */
class UserLessonProgress extends AbstractEntity
{
    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
     */
    protected FrontendUser $user;

    /**
     * @var \Equed\EquedLms\Domain\Model\Lesson
     */
    protected Lesson $lesson;

    protected bool $completed = false;

    protected ?\DateTime $completionDate = null;

    public function getUser(): FrontendUser
    {
        return $this->user;
    }

    public function setUser(FrontendUser $user): void
    {
        $this->user = $user;
    }

    public function getLesson(): Lesson
    {
        return $this->lesson;
    }

    public function setLesson(Lesson $lesson): void
    {
        $this->lesson = $lesson;
    }

    public function isCompleted(): bool
    {
        return $this->completed;
    }

    public function setCompleted(bool $completed): void
    {
        $this->completed = $completed;
    }

    public function getCompletionDate(): ?\DateTime
    {
        return $this->completionDate;
    }

    public function setCompletionDate(?\DateTime $completionDate): void
    {
        $this->completionDate = $completionDate;
    }
}