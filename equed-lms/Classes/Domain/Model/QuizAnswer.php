<?php

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Represents a single answer option for a quiz question.
 */
class QuizAnswer extends AbstractEntity
{
    protected string $text = '';

    protected bool $isCorrect = false;

    /**
     * @var \Equed\EquedLms\Domain\Model\QuizQuestion
     */
    protected QuizQuestion $question;

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function isCorrect(): bool
    {
        return $this->isCorrect;
    }

    public function setIsCorrect(bool $isCorrect): void
    {
        $this->isCorrect = $isCorrect;
    }

    public function getQuestion(): QuizQuestion
    {
        return $this->question;
    }

    public function setQuestion(QuizQuestion $question): void
    {
        $this->question = $question;
    }
}