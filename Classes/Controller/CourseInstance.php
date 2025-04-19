<?php
declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Equed\EquedLms\Domain\Model\CourseProgram;
use Equed\EquedLms\Domain\Model\TrainingCenter;
use Equed\EquedLms\Domain\Model\FrontendUser;

class CourseInstance extends AbstractEntity
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
     * @var \DateTime|null
     */
    protected ?\DateTime $startDate = null;

    /**
     * @var \DateTime|null
     */
    protected ?\DateTime $endDate = null;

    /**
     * @var string
     */
    protected string $language = 'en';

    /**
     * @var CourseProgram|null
     */
    protected ?CourseProgram $courseProgram = null;

    /**
     * @var TrainingCenter|null
     */
    protected ?TrainingCenter $trainingCenter = null;

    /**
     * @var ObjectStorage<FrontendUser>
     */
    protected ObjectStorage $instructors;

    /**
     * @var bool
     */
    protected bool $isActive = true;

    /**
     * @var bool
     */
    protected bool $isVisible = true;

    /**
     * @var int
     */
    protected int $maxParticipants = 0;

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
        $this->instructors = new ObjectStorage();
    }

    // Getter & Setter

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

    public function getStartDate(): ?\DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getEndDate(): ?\DateTime
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }

    public function getCourseProgram(): ?CourseProgram
    {
        return $this->courseProgram;
    }

    public function setCourseProgram(?CourseProgram $courseProgram): void
    {
        $this->courseProgram = $courseProgram;
    }

    public function getTrainingCenter(): ?TrainingCenter
    {
        return $this->trainingCenter;
    }

    public function setTrainingCenter(?TrainingCenter $trainingCenter): void
    {
        $this->trainingCenter = $trainingCenter;
    }

    public function getInstructors(): ObjectStorage
    {
        return $this->instructors;
    }

    public function setInstructors(ObjectStorage $instructors): void
    {
        $this->instructors = $instructors;
    }

    public function addInstructor(FrontendUser $instructor): void
    {
        $this->instructors->attach($instructor);
    }

    public function removeInstructor(FrontendUser $instructor): void
    {
        $this->instructors->detach($instructor);
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

    public function isVisible(): bool
    {
        return $this->isVisible;
    }

    public function setIsVisible(bool $isVisible): void
    {
        $this->isVisible = $isVisible;
    }

    public function getMaxParticipants(): int
    {
        return $this->maxParticipants;
    }

    public function setMaxParticipants(int $maxParticipants): void
    {
        $this->maxParticipants = $maxParticipants;
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

