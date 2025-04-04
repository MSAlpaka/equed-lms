<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * A question in a quiz, linked to a lesson.
 */
class QuizQuestion extends AbstractEntity
{
    /**
     * @var string
     */
    protected string $questionText = '';

    /**
     * @var ObjectStorage<QuizAnswer>
     */
    protected ObjectStorage $answers;

    /**
     * Zugeordnete Lektion
     *
     * @var Lesson|null
     */
    protected ?Lesson $lesson = null;

    /**
     * Gibt an, ob die Frage versteckt ist
     *
     * @var bool
     */
    protected bool $hidden = false;

    /**
     * Schwierigkeitsgrad (z. B. easy, medium, hard)
     *
     * @var string
     */
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
     * @return ObjectStorage<QuizAnswer>
     */
    public function getAnswers(): ObjectStorage
    {
        return $this->answers;
    }

    /**
     * @param ObjectStorage<QuizAnswer> $answers
     */
    public function setAnswers(ObjectStorage $answers): void
    {
        $this->answers = $answers;
    }

    public function addAnswer(QuizAnswer $answer): void
    {
        $this->answers->attach($answer);
    }

    public function removeAnswer(QuizAnswer $answer): void
    {
        $this->answers->detach($answer);
    }

    public function getLesson(): ?Lesson
    {
        return $this->lesson;
    }

    public function setLesson(?Lesson $lesson): void
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