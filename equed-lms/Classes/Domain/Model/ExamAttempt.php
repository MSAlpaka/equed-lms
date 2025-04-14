<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;

/**
 * Einzelner Prüfungs- oder Quizversuch eines Teilnehmenden.
 *
 * Enthält Antwort, Korrektheit, Versuchsnummer, Modus, Zeitstempel und optionales Feedback.
 */
class ExamAttempt extends AbstractEntity
{
    protected int $pid = 0;

    #[Lazy]
    protected ?FrontendUser $user = null;

    #[Lazy]
    protected ?QuizQuestion $quizQuestion = null;

    protected string $givenAnswer = '';

    protected bool $correct = false;

    protected ?\DateTimeImmutable $timestamp = null;

    protected int $attemptNumber = 1;

    /**
     * Modus z. B. 'practice', 'final', 'retake'
     */
    protected string $mode = 'practice';

    protected string $reviewComment = '';

    protected bool $isReviewed = false;

    public function getPid(): int
    {
        return $this->pid;
    }

    public function setPid(int $pid): void
    {
        $this->pid = $pid;
    }

    public function getUser(): ?FrontendUser
    {
        return $this->user;
    }

    public function setUser(?FrontendUser $user): void
    {
        $this->user = $user;
    }

    public function getQuizQuestion(): ?QuizQuestion
    {
        return $this->quizQuestion;
    }

    public function setQuizQuestion(?QuizQuestion $quizQuestion): void
    {
        $this->quizQuestion = $quizQuestion;
    }

    public function getGivenAnswer(): string
    {
        return $this->givenAnswer;
    }

    public function setGivenAnswer(string $givenAnswer): void
    {
        $this->givenAnswer = $givenAnswer;
    }

    public function isCorrect(): bool
    {
        return $this->correct;
    }

    public function setCorrect(bool $correct): void
    {
        $this->correct = $correct;
    }

    public function getTimestamp(): ?\DateTimeImmutable
    {
        return $this->timestamp;
    }

    public function setTimestamp(?\DateTimeImmutable $timestamp): void
    {
        $this->timestamp = $timestamp;
    }

    public function getAttemptNumber(): int
    {
        return $this->attemptNumber;
    }

    public function setAttemptNumber(int $attemptNumber): void
    {
        $this->attemptNumber = $attemptNumber;
    }

    public function getMode(): string
    {
        return $this->mode;
    }

    public function setMode(string $mode): void
    {
        $this->mode = $mode;
    }

    public function getReviewComment(): string
    {
        return $this->reviewComment;
    }

    public function setReviewComment(string $reviewComment): void
    {
        $this->reviewComment = $reviewComment;
    }

    public function isReviewed(): bool
    {
        return $this->isReviewed;
    }

    public function setIsReviewed(bool $isReviewed): void
    {
        $this->isReviewed = $isReviewed;
    }
}