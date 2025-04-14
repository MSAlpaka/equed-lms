<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;

/**
 * Antwortoption zu einer Quizfrage.
 */
class QuizAnswer extends AbstractEntity
{
    protected int $pid = 0;

    protected string $answerText = '';
    protected bool $isCorrect = false;
    protected string $feedbackText = '';
    protected int $position = 0;

    #[Lazy]
    protected ?FileReference $image = null;

    #[Lazy]
    protected ?QuizQuestion $question = null;

    public function getAnswerText(): string { return $this->answerText; }
    public function setAnswerText(string $text): void { $this->answerText = $text; }

    public function isCorrect(): bool { return $this->isCorrect; }
    public function setIsCorrect(bool $value): void { $this->isCorrect = $value; }

    public function getFeedbackText(): string { return $this->feedbackText; }
    public function setFeedbackText(string $text): void { $this->feedbackText = $text; }

    public function getPosition(): int { return $this->position; }
    public function setPosition(int $position): void { $this->position = $position; }

    public function getImage(): ?FileReference { return $this->image; }
    public function setImage(?FileReference $image): void { $this->image = $image; }

    public function getQuestion(): ?QuizQuestion { return $this->question; }
    public function setQuestion(?QuizQuestion $question): void { $this->question = $question; }
}