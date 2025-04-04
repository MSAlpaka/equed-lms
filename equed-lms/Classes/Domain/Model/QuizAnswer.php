<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;

/**
 * Represents a single answer option for a quiz question.
 *
 * Can be marked correct/incorrect, and include feedback and optional image.
 */
class QuizAnswer extends AbstractEntity
{
    /**
     * Answer text shown to the learner
     */
    protected string $answerText = '';

    /**
     * Is this the correct answer?
     */
    protected bool $isCorrect = false;

    /**
     * Optional feedback shown after answering (e.g. explanation)
     */
    protected string $feedbackText = '';

    /**
     * Optional sorting position
     */
    protected int $position = 0;

    /**
     * Optional image for visual answers
     */
    protected ?FileReference $image = null;

    /**
     * The related quiz question
     */
    protected ?QuizQuestion $question = null;

    public function getAnswerText(): string
    {
        return $this->answerText;
    }

    public function setAnswerText(string $answerText): void
    {
        $this->answerText = $answerText;
    }

    public function isCorrect(): bool
    {
        return $this->isCorrect;
    }

    public function setIsCorrect(bool $isCorrect): void
    {
        $this->isCorrect = $isCorrect;
    }

    public function getFeedbackText(): string
    {
        return $this->feedbackText;
    }

    public function setFeedbackText(string $feedbackText): void
    {
        $this->feedbackText = $feedbackText;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    public function getImage(): ?FileReference
    {
        return $this->image;
    }

    public function setImage(?FileReference $image): void
    {
        $this->image = $image;
    }

    public function getQuestion(): ?QuizQuestion
    {
        return $this->question;
    }

    public function setQuestion(?QuizQuestion $question): void
    {
        $this->question = $question;
    }
}