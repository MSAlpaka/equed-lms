<?php

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;

/**
 * Represents a single quiz/exam attempt for a question.
 */
class ExamAttempt extends AbstractEntity
{
    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
     */
    protected FrontendUser $user;

    /**
     * @var \Equed\EquedLms\Domain\Model\QuizQuestion
     */
    protected QuizQuestion $quizQuestion;

    protected string $givenAnswer = '';

    protected bool $correct = false;

    protected ?\DateTime $timestamp = null;

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
}