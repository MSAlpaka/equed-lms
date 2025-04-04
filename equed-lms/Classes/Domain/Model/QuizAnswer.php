<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Antwortmöglichkeit zu einer Quizfrage
 */
class QuizAnswer extends AbstractEntity
{
    /**
     * Antworttext
     *
     * @var string
     */
    protected string $answerText = '';

    /**
     * Ist diese Antwort korrekt?
     *
     * @var bool
     */
    protected bool $isCorrect = false;

    /**
     * Zugehörige Frage
     *
     * @var QuizQuestion|null
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

    public function getQuestion(): ?QuizQuestion
    {
        return $this->question;
    }

    public function setQuestion(?QuizQuestion $question): void
    {
        $this->question = $question;
    }
}