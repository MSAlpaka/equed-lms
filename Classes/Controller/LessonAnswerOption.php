<?php
declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use Equed\EquedLms\Domain\Model\LessonQuestion;

class LessonAnswerOption extends AbstractEntity
{
    /**
     * @var string
     */
    protected string $answerText = '';

    /**
     * @var bool
     */
    protected bool $isCorrect = false;

    /**
     * @var string
     */
    protected string $explanation = '';

    /**
     * @var int
     */
    protected int $orderNumber = 0;

    /**
     * @var LessonQuestion|null
     */
    protected ?LessonQuestion $question = null;

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

    // === GETTER UND SETTER ===

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

    public function getExplanation(): string
    {
        return $this->explanation;
    }

    public function setExplanation(string $explanation): void
    {
        $this->explanation = $explanation;
    }

    public function getOrderNumber(): int
    {
        return $this->orderNumber;
    }

    public function setOrderNumber(int $orderNumber): void
    {
        $this->orderNumber = $orderNumber;
    }

    public function getQuestion(): ?LessonQuestion
    {
        return $this->question;
    }

    public function setQuestion(?LessonQuestion $question): void
    {
        $this->question = $question;
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

