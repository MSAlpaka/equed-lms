<?php
declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Equed\EquedLms\Domain\Model\LessonQuiz;
use Equed\EquedLms\Domain\Model\LessonAnswerOption;

class LessonQuestion extends AbstractEntity
{
    /**
     * @var string
     */
    protected string $questionText = '';

    /**
     * @var string
     */
    protected string $questionType = 'single_choice'; // single_choice, multiple_choice, text, rating, matching

    /**
     * @var int
     */
    protected int $points = 1;

    /**
     * @var int
     */
    protected int $orderNumber = 0;

    /**
     * @var bool
     */
    protected bool $isRequired = true;

    /**
     * @var LessonQuiz|null
     */
    protected ?LessonQuiz $quiz = null;

    /**
     * @var ObjectStorage<LessonAnswerOption>
     */
    protected ObjectStorage $answerOptions;

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
        $this->answerOptions = new ObjectStorage();
    }

    // === GETTER UND SETTER ===

    public function getQuestionText(): string
    {
        return $this->questionText;
    }

    public function setQuestionText(string $questionText): void
    {
        $this->questionText = $questionText;
    }

    public function getQuestionType(): string
    {
        return $this->questionType;
    }

    public function setQuestionType(string $questionType): void
    {
        $this->questionType = $questionType;
    }

    public function getPoints(): int
    {
        return $this->points;
    }

    public function setPoints(int $points): void
    {
        $this->points = $points;
    }

    public function getOrderNumber(): int
    {
        return $this->orderNumber;
    }

    public function setOrderNumber(int $orderNumber): void
    {
        $this->orderNumber = $orderNumber;
    }

    public function isRequired(): bool
    {
        return $this->isRequired;
    }

    public function setIsRequired(bool $isRequired): void
    {
        $this->isRequired = $isRequired;
    }

    public function getQuiz(): ?LessonQuiz
    {
        return $this->quiz;
    }

    public function setQuiz(?LessonQuiz $quiz): void
    {
        $this->quiz = $quiz;
    }

    public function getAnswerOptions(): ObjectStorage
    {
        return $this->answerOptions;
    }

    public function setAnswerOptions(ObjectStorage $answerOptions): void
    {
        $this->answerOptions = $answerOptions;
    }

    public function addAnswerOption(LessonAnswerOption $option): void
    {
        $this->answerOptions->attach($option);
    }

    public function removeAnswerOption(LessonAnswerOption $option): void
    {
        $this->answerOptions->detach($option);
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

