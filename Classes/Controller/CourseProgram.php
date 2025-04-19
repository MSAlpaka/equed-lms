<?php
declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class CourseProgram extends AbstractEntity
{
    /**
     * @var string
     */
    protected string $title = '';

    /**
     * @var string
     */
    protected string $subtitle = '';

    /**
     * @var string
     */
    protected string $slug = '';

    /**
     * @var string
     */
    protected string $description = '';

    /**
     * @var int
     */
    protected int $durationHours = 0;

    /**
     * @var string
     */
    protected string $targetGroup = '';

    /**
     * @var string
     */
    protected string $requirements = '';

    /**
     * @var string
     */
    protected string $certificationType = '';

    /**
     * @var string
     */
    protected string $goal = '';

    /**
     * @var bool
     */
    protected bool $isActive = true;

    /**
     * @var bool
     */
    protected bool $isSpecialty = false;

    /**
     * @var bool
     */
    protected bool $requiresExternalExaminer = false;

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

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Equed\EquedLms\Domain\Model\CourseGoal>
     */
    protected ObjectStorage $courseGoals;

    public function __construct()
    {
        $this->courseGoals = new ObjectStorage();
    }

    // Getter & Setter für alle Felder

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getSubtitle(): string
    {
        return $this->subtitle;
    }

    public function setSubtitle(string $subtitle): void
    {
        $this->subtitle = $subtitle;
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

    public function getDurationHours(): int
    {
        return $this->durationHours;
    }

    public function setDurationHours(int $durationHours): void
    {
        $this->durationHours = $durationHours;
    }

    public function getTargetGroup(): string
    {
        return $this->targetGroup;
    }

    public function setTargetGroup(string $targetGroup): void
    {
        $this->targetGroup = $targetGroup;
    }

    public function getRequirements(): string
    {
        return $this->requirements;
    }

    public function setRequirements(string $requirements): void
    {
        $this->requirements = $requirements;
    }

    public function getCertificationType(): string
    {
        return $this->certificationType;
    }

    public function setCertificationType(string $certificationType): void
    {
        $this->certificationType = $certificationType;
    }

    public function getGoal(): string
    {
        return $this->goal;
    }

    public function setGoal(string $goal): void
    {
        $this->goal = $goal;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

    public function isSpecialty(): bool
    {
        return $this->isSpecialty;
    }

    public function setIsSpecialty(bool $isSpecialty): void
    {
        $this->isSpecialty = $isSpecialty;
    }

    public function requiresExternalExaminer(): bool
    {
        return $this->requiresExternalExaminer;
    }

    public function setRequiresExternalExaminer(bool $requiresExternalExaminer): void
    {
        $this->requiresExternalExaminer = $requiresExternalExaminer;
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

    public function getCourseGoals(): ObjectStorage
    {
        return $this->courseGoals;
    }

    public function setCourseGoals(ObjectStorage $courseGoals): void
    {
        $this->courseGoals = $courseGoals;
    }

    public function addCourseGoal(CourseGoal $goal): void
    {
        $this->courseGoals->attach($goal);
    }

    public function removeCourseGoal(CourseGoal $goal): void
    {
        $this->courseGoals->detach($goal);
    }
}

