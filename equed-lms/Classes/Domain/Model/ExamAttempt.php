<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;

/**
 * Represents a single quiz or exam attempt by a user for a specific question.
 * 
 * Tracks answers, correctness, mode and reviewer feedback.
 */
class ExamAttempt extends AbstractEntity
{
    /**
     * User who submitted the answer
     */
    protected FrontendUser $user;

    /**
     * The related quiz question
     */
    protected QuizQuestion $quizQuestion;

    /**
     * Raw answer given by the user (can be string or JSON)
     */
    protected string $givenAnswer = '';

    /**
     * Was the answer correct?
     */
    protected bool $correct = false;

    /**
     * When was the answer submitted?
     */
    protected ?\DateTime $timestamp = null;

    /**
     * Attempt number (e.g. 1 for first attempt)
     */
    protected int $attemptNumber = 1;

    /**
     * Mode of the attempt: practice, final, retake
     */
    protected string $mode = 'practice';

    /**
     * Optional reviewer comment
     */
    protected string $reviewComment = '';

    /**
     * Was the attempt manually reviewed?
     */
    protected bool $isReviewed = false;

    public function getUser(): FrontendUser
    {
        return $this->user;
    }

    public function setUser(FrontendUser $user): void
    {
        $this->user = $user;
    }

    public function getQuizQuestion(): QuizQuestion
    {
        return $this->quizQuestion;
    }

    public function setQuizQuestion(QuizQuestion $quizQuestion): void
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

    public function getTimestamp(): ?\DateTime
    {
        return $this->timestamp;
    }

    public function setTimestamp(?\DateTime $timestamp): void
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