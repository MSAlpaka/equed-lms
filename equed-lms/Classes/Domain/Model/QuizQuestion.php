<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class QuizQuestion extends AbstractEntity
{
    protected string $questionText = '';

    /**
     * @var ObjectStorage<\Equed\EquedLms\Domain\Model\QuizAnswer>
     */
    protected ObjectStorage $answers;

    protected int $lesson = 0;

    protected bool $hidden = false;

    protected string $difficulty = '';

    public function __construct()
    {
        $this->answers = new ObjectStorage();
    }

    public function getQuestionText(): string
    {
        return $this->questionText;
    }

    public function setQuestionText(string $questionText): void
    {
        $this->questionText = $questionText;
    }

    /**
     * @return ObjectStorage<\Equed\EquedLms\Domain\Model\QuizAnswer>
     */
    public function getAnswers(): ObjectStorage
    {
        return $this->answers;
    }

    /**
     * @param ObjectStorage<\Equed\EquedLms\Domain\Model\QuizAnswer> $answers
     */
    public function setAnswers(ObjectStorage $answers): void
    {
        $this->answers = $answers;
    }

    public function getLesson(): int
    {
        return $this->lesson;
    }

    public function setLesson(int $lesson): void
    {
        $this->lesson = $lesson;
    }

    public function isHidden(): bool
    {
        return $this->hidden;
    }

    public function setHidden(bool $hidden): void
    {
        $this->hidden = $hidden;
    }

    public function getDifficulty(): string
    {
        return $this->difficulty;
    }

    public function setDifficulty(string $difficulty): void
    {
        $this->difficulty = $difficulty;
    }
}