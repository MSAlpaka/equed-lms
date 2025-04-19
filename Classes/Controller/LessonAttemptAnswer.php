<?php
declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use Equed\EquedLms\Domain\Model\LessonAttempt;
use Equed\EquedLms\Domain\Model\LessonQuestion;
use Equed\EquedLms\Domain\Model\LessonAnswerOption;

class LessonAttemptAnswer extends AbstractEntity
{
    /**
     * @var LessonAttempt|null
     */
    protected ?LessonAttempt $attempt = null;

    /**
     * @var LessonQuestion|null
     */
    protected ?LessonQuestion $question = null;

    /**
     * @var LessonAnswerOption|null
     */
    protected ?LessonAnswerOption $selectedOption = null;

    /**
     * @var string
     */
    protected string $answerText = '';

    /**
     * @var bool
     */
    protected bool $isCorrect = false;

    /**
     * @var int
     */
    protected int $pointsAwarded = 0;

    /**
     * @var string
     */
    protected string $reviewComment = '';

    /**
     * @var \DateTime|null
     */
    protected ?\DateTime $answeredAt = null;

    /**
     * @var string
     */
    protected string $uuid = '';

    public function getAttempt(): ?LessonAttempt
    {
        return $this->attempt;
    }

    public function setAttempt(?LessonAttempt $attempt): void
    {
        $this->attempt = $attempt;
    }

    public function getQuestion(): ?LessonQuestion
    {
        return $this->question;
    }

    public function setQuestion(?LessonQuestion $question): void
    {
        $this->question = $question;
    }

    public function getSelectedOption(): ?LessonAnswerOption
    {
        return $this->selectedOption;
    }

    public function setSelectedOption(?LessonAnswerOption $selectedOption): void
    {
        $this->selectedOption = $selectedOption;
    }

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

    public function getPointsAwarded(): int
    {
        return $this->pointsAwarded;
    }

    public function setPointsAwarded(int $pointsAwarded): void
    {
        $this->pointsAwarded = $pointsAwarded;
    }

    public function getReviewComment(): string
    {
        return $this->reviewComment;
    }

    public function setReviewComment(string $reviewComment): void
    {
        $this->reviewComment = $reviewComment;
    }

    public function getAnsweredAt(): ?\DateTime
    {
        return $this->answeredAt;
    }

    public function setAnsweredAt(?\DateTime $answeredAt): void
    {
        $this->answeredAt = $answeredAt;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }
}

