<?php
declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Equed\EquedLms\Domain\Model\Lesson;
use Equed\EquedLms\Domain\Model\LessonQuestion;

class LessonQuiz extends AbstractEntity
{
    /**
     * @var string
     */
    protected string $title = '';

    /**
     * @var string
     */
    protected string $description = '';

    /**
     * @var Lesson|null
     */
    protected ?Lesson $lesson = null;

    /**
     * @var int
     */
    protected int $minScorePercent = 70;

    /**
     * @var bool
     */
    protected bool $allowRetry = true;

    /**
     * @var int
     */
    protected int $maxAttempts = 3;

    /**
     * @var bool
     */
    protected bool $shuffleQuestions = true;

    /**
     * @var ObjectStorage<LessonQuestion>
     */
    protected ObjectStorage $questions;

    /**
     * @var string
     */
    protected string $uuid = '';

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
        $this->questions = new ObjectStorage();
    }

    // === GETTER UND SETTER ===

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getLesson(): ?Lesson
    {
        return $this->lesson;
    }

    public function setLesson(?Lesson $lesson): void
    {
        $this->lesson = $lesson;
    }

    public function getMinScorePercent(): int
    {
        return $this->minScorePercent;
    }

    public function setMinScorePercent(int $minScorePercent): void
    {
        $this->minScorePercent = $minScorePercent;
    }

    public function isAllowRetry(): bool
    {
        return $this->allowRetry;
    }

    public function setAllowRetry(bool $allowRetry): void
    {
        $this->allowRetry = $allowRetry;
    }

    public function getMaxAttempts(): int
    {
        return $this->maxAttempts;
    }

    public function setMaxAttempts(int $maxAttempts): void
    {
        $this->maxAttempts = $maxAttempts;
    }

    public function isShuffleQuestions(): bool
    {
        return $this->shuffleQuestions;
    }

    public function setShuffleQuestions(bool $shuffleQuestions): void
    {
        $this->shuffleQuestions = $shuffleQuestions;
    }

    public function getQuestions(): ObjectStorage
    {
        return $this->questions;
    }

    public function setQuestions(ObjectStorage $questions): void
    {
        $this->questions = $questions;
    }

    public function addQuestion(LessonQuestion $question): void
    {
        $this->questions->attach($question);
    }

    public function removeQuestion(LessonQuestion $question): void
    {
        $this->questions->detach($question);
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
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

