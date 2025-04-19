<?php
declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Equed\EquedLms\Domain\Model\CourseProgram;
use Equed\EquedLms\Domain\Model\LessonQuiz;
use Equed\EquedLms\Domain\Model\CourseMaterial;
use Equed\EquedLms\Domain\Model\ContentPage;

class Lesson extends AbstractEntity
{
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
    protected string $description = '';

    /**
     * @var string
     */
    protected string $lessonType = 'content'; // content, quiz, file, video, reflection

    /**
     * @var int
     */
    protected int $orderNumber = 0;

    /**
     * @var string
     */
    protected string $duration = ''; // z. B. "15min", "1h"

    /**
     * @var CourseProgram|null
     */
    protected ?CourseProgram $courseProgram = null;

    /**
     * @var ObjectStorage<ContentPage>
     */
    protected ObjectStorage $pages;

    /**
     * @var ObjectStorage<CourseMaterial>
     */
    protected ObjectStorage $materials;

    /**
     * @var LessonQuiz|null
     */
    protected ?LessonQuiz $quiz = null;

    /**
     * @var bool
     */
    protected bool $isLocked = false;

    /**
     * @var bool
     */
    protected bool $isVisible = true;

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
        $this->pages = new ObjectStorage();
        $this->materials = new ObjectStorage();
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

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getLessonType(): string
    {
        return $this->lessonType;
    }

    public function setLessonType(string $lessonType): void
    {
        $this->lessonType = $lessonType;
    }

    public function getOrderNumber(): int
    {
        return $this->orderNumber;
    }

    public function setOrderNumber(int $orderNumber): void
    {
        $this->orderNumber = $orderNumber;
    }

    public function getDuration(): string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): void
    {
        $this->duration = $duration;
    }

    public function getCourseProgram(): ?CourseProgram
    {
        return $this->courseProgram;
    }

    public function setCourseProgram(?CourseProgram $courseProgram): void
    {
        $this->courseProgram = $courseProgram;
    }

    public function getPages(): ObjectStorage
    {
        return $this->pages;
    }

    public function setPages(ObjectStorage $pages): void
    {
        $this->pages = $pages;
    }

    public function addPage(ContentPage $page): void
    {
        $this->pages->attach($page);
    }

    public function removePage(ContentPage $page): void
    {
        $this->pages->detach($page);
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

    public function getQuiz(): ?LessonQuiz
    {
        return $this->quiz;
    }

    public function setQuiz(?LessonQuiz $quiz): void
    {
        $this->quiz = $quiz;
    }

    public function isLocked(): bool
    {
        return $this->isLocked;
    }

    public function setIsLocked(bool $isLocked): void
    {
        $this->isLocked = $isLocked;
    }

    public function isVisible(): bool
    {
        return $this->isVisible;
    }

    public function setIsVisible(bool $isVisible): void
    {
        $this->isVisible = $isVisible;
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

