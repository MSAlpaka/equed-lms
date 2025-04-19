<?php
declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Equed\EquedLms\Domain\Model\FrontendUser;
use Equed\EquedLms\Domain\Model\Lesson;
use Equed\EquedLms\Domain\Model\LessonQuiz;
use Equed\EquedLms\Domain\Model\LessonAttemptAnswer;

class LessonAttempt extends AbstractEntity
{
    /**
     * @var FrontendUser|null
     */
    protected ?FrontendUser $user = null;

    /**
     * @var Lesson|null
     */
    protected ?Lesson $lesson = null;

    /**
     * @var LessonQuiz|null
     */
    protected ?LessonQuiz $quiz = null;

    /**
     * @var int
     */
    protected int $attemptNumber = 1;

    /**
     * @var int
     */
    protected int $score = 0;

    /**
     * @var bool
     */
    protected bool $passed = false;

    /**
     * @var string
     */
    protected string $status = 'submitted'; // values: draft, submitted, reviewed, invalidated

    /**
     * @var string
     */
    protected string $ipAddress = '';

    /**
     * @var string
     */
    protected string $userAgent = '';

    /**
     * @var ObjectStorage<LessonAttemptAnswer>
     */
    protected ObjectStorage $answers;

    /**
     * @var string
     */
    protected string $uuid = '';

    /**
     * @var \DateTime|null
     */
    protected ?\DateTime $startedAt = null;

    /**
     * @var \DateTime|null
     */
    protected ?\DateTime $submittedAt = null;

    /**
     * @var \DateTime|null
     */
    protected ?\DateTime $createdAt = null;

    /**
     * @var \DateTime|null
     */
    protected ?\DateTime $updatedAt = null;

    public function __construct()
    {
        $this->answers = new ObjectStorage();
    }

    // === GETTER UND SETTER ===

    public function getUser(): ?FrontendUser
    {
        return $this->user;
    }

    public function setUser(?FrontendUser $user): void
    {
        $this->user = $user;
    }

    public function getLesson(): ?Lesson
    {
        return $this->lesson;
    }

    public function setLesson(?Lesson $lesson): void
    {
        $this->lesson = $lesson;
    }

    public function getQuiz(): ?LessonQuiz
    {
        return $this->quiz;
    }

    public function setQuiz(?LessonQuiz $quiz): void
    {
        $this->quiz = $quiz;
    }

    public function getAttemptNumber(): int
    {
        return $this->attemptNumber;
    }

    public function setAttemptNumber(int $attemptNumber): void
    {
        $this->attemptNumber = $attemptNumber;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function setScore(int $score): void
    {
        $this->score = $score;
    }

    public function isPassed(): bool
    {
        return $this->passed;
    }

    public function setPassed(bool $passed): void
    {
        $this->passed = $passed;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getIpAddress(): string
    {
        return $this->ipAddress;
    }

    public function setIpAddress(string $ipAddress): void
    {
        $this->ipAddress = $ipAddress;
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    public function setUserAgent(string $userAgent): void
    {
        $this->userAgent = $userAgent;
    }

    public function getAnswers(): ObjectStorage
    {
        return $this->answers;
    }

    public function setAnswers(ObjectStorage $answers): void
    {
        $this->answers = $answers;
    }

    public function addAnswer(LessonAttemptAnswer $answer): void
    {
        $this->answers->attach($answer);
    }

    public function removeAnswer(LessonAttemptAnswer $answer): void
    {
        $this->answers->detach($answer);
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    public function getStartedAt(): ?\DateTime
    {
        return $this->startedAt;
    }

    public function setStartedAt(?\DateTime $startedAt): void
    {
        $this->startedAt = $startedAt;
    }

    public function getSubmittedAt(): ?\DateTime
    {
        return $this->submittedAt;
    }

    public function setSubmittedAt(?\DateTime $submittedAt): void
    {
        $this->submittedAt = $submittedAt;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}

