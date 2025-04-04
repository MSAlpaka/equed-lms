<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;

/**
 * A question in a quiz, linked to a lesson.
 *
 * Can include answers, media, difficulty and explanation.
 */
class QuizQuestion extends AbstractEntity
{
    /**
     * The question text shown to the learner
     */
    protected string $questionText = '';

    /**
     * Optional explanation shown after answering
     */
    protected string $explanation = '';

    /**
     * Question type: single_choice, multiple_choice, text
     */
    protected string $questionType = 'single_choice';

    /**
     * Optional image or media for the question
     */
    protected ?FileReference $image = null;

    /**
     * Optional point value for this question
     */
    protected int $score = 1;

    /**
     * Sort order in the lesson
     */
    protected int $position = 0;

    /**
     * Optional difficulty (e.g. easy, medium, hard)
     */
    protected string $difficulty = 'medium';

    /**
     * Is the question hidden?
     */
    protected bool $hidden = false;

    /**
     * Related lesson
     */
    protected ?Lesson $lesson = null;

    /**
     * Possible answers
     *
     * @var ObjectStorage<QuizAnswer>
     */
    protected ObjectStorage $answers;

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

    public function getExplanation(): string
    {
        return $this->explanation;
    }

    public function setExplanation(string $explanation): void
    {
        $this->explanation = $explanation;
    }

    public function getQuestionType(): string
    {
        return $this->questionType;
    }

    public function setQuestionType(string $questionType): void
    {
        $this->questionType = $questionType;
    }

    public function getImage(): ?FileReference
    {
        return $this->image;
    }

    public function setImage(?FileReference $image): void
    {
        $this->image = $image;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function setScore(int $score): void
    {
        $this->score = $score;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    public function getDifficulty(): string
    {
        return $this->difficulty;
    }

    public function setDifficulty(string $difficulty): void
    {
        $this->difficulty = $difficulty;
    }

    public function isHidden(): bool
    {
        return $this->hidden;
    }

    public function setHidden(bool $hidden): void
    {
        $this->hidden = $hidden;
    }

    public function getLesson(): ?Lesson
    {
        return $this->lesson;
    }

    public function setLesson(?Lesson $lesson): void
    {
        $this->lesson = $lesson;
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
}