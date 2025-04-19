<?php
declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Equed\EquedLms\Domain\Model\Lesson;
use Equed\EquedLms\Domain\Model\LessonQuiz;
use Equed\EquedLms\Domain\Model\CourseMaterial;

class ContentPage extends AbstractEntity
{
    /**
     * @var Lesson|null
     */
    protected ?Lesson $lesson = null;

    /**
     * @var string
     */
    protected string $title = '';

    /**
     * @var string
     */
    protected string $slug = '';

    /**
     * @var string
     */
    protected string $pageType = 'text'; // e.g. text, video, quiz, material, external

    /**
     * @var string
     */
    protected string $content = ''; // RTE or Markdown for text pages

    /**
     * @var string
     */
    protected string $videoUrl = '';

    /**
     * @var LessonQuiz|null
     */
    protected ?LessonQuiz $quiz = null;

    /**
     * @var ObjectStorage<CourseMaterial>
     */
    protected ObjectStorage $materials;

    /**
     * @var bool
     */
    protected bool $isRequired = false;

    /**
     * @var int
     */
    protected int $orderNumber = 0;

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
        $this->materials = new ObjectStorage();
    }

    // === GETTER UND SETTER ===

    public function getLesson(): ?Lesson
    {
        return $this->lesson;
    }

    public function setLesson(?Lesson $lesson): void
    {
        $this->lesson = $lesson;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function getPageType(): string
    {
        return $this->pageType;
    }

    public function setPageType(string $pageType): void
    {
        $this->pageType = $pageType;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getVideoUrl(): string
    {
        return $this->videoUrl;
    }

    public function setVideoUrl(string $videoUrl): void
    {
        $this->videoUrl = $videoUrl;
    }

    public function getQuiz(): ?LessonQuiz
    {
        return $this->quiz;
    }

    public function setQuiz(?LessonQuiz $quiz): void
    {
        $this->quiz = $quiz;
    }

    public function getMaterials(): ObjectStorage
    {
        return $this->materials;
    }

    public function setMaterials(ObjectStorage $materials): void
    {
        $this->materials = $materials;
    }

    public function addMaterial(CourseMaterial $material): void
    {
        $this->materials->attach($material);
    }

    public function removeMaterial(CourseMaterial $material): void
    {
        $this->materials->detach($material);
    }

    public function isRequired(): bool
    {
        return $this->isRequired;
    }

    public function setIsRequired(bool $isRequired): void
    {
        $this->isRequired = $isRequired;
    }

    public function getOrderNumber(): int
    {
        return $this->orderNumber;
    }

    public function setOrderNumber(int $orderNumber): void
    {
        $this->orderNumber = $orderNumber;
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

