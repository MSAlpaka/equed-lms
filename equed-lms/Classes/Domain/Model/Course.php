<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;

/**
 * This class represents a Course in the EquEd LMS.
 *
 * Courses define the curriculum and serve as the basis for certification and progression.
 */
class Course extends AbstractEntity
{
    protected string $title = '';
    protected string $description = '';
    protected string $category = '';
    protected bool $isActive = true;

    /** @var string Learning outcome / goal (e.g. "HoofCare Specialist") */
    protected string $finishGoal = '';

    /** @var array<int, string> List of course shortnames required to participate */
    protected array $prerequisites = [];

    /** @var FileReference Optional reference to image or banner for the course */
    protected ?FileReference $image = null;

    /** @var Center Assigned training center (for validation and administration) */
    protected ?Center $center = null;

    /** @var bool Determines if this course can lead to a certificate */
    protected bool $grantsCertificate = true;

    /** @var int Internal sort order for display in frontend */
    protected int $sorting = 0;

    /** @var array<int, string> Optional array of recommended follow-up specialties */
    protected array $recommendedSpecialties = [];

    /** @var ObjectStorage<Lesson> Lessons assigned to this course */
    protected ObjectStorage $lessons;

    /** @var User|null Instructor assigned to the course */
    protected ?User $instructor = null;

    /** @var bool Whether external validation is required for this course */
    protected bool $requiresExternalValidation = false;

    public function __construct()
    {
        $this->lessons = new ObjectStorage();
    }

    // Getter and Setter methods for all properties

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

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

    public function getFinishGoal(): string
    {
        return $this->finishGoal;
    }

    public function setFinishGoal(string $finishGoal): void
    {
        $this->finishGoal = $finishGoal;
    }

    /**
     * @return array<int, string>
     */
    public function getPrerequisites(): array
    {
        return $this->prerequisites;
    }

    /**
     * @param array<int, string> $prerequisites
     */
    public function setPrerequisites(array $prerequisites): void
    {
        $this->prerequisites = $prerequisites;
    }

    public function getImage(): ?FileReference
    {
        return $this->image;
    }

    public function setImage(?FileReference $image): void
    {
        $this->image = $image;
    }

    public function getCenter(): ?Center
    {
        return $this->center;
    }

    public function setCenter(?Center $center): void
    {
        $this->center = $center;
    }

    public function grantsCertificate(): bool
    {
        return $this->grantsCertificate;
    }

    public function setGrantsCertificate(bool $grantsCertificate): void
    {
        $this->grantsCertificate = $grantsCertificate;
    }

    public function getSorting(): int
    {
        return $this->sorting;
    }

    public function setSorting(int $sorting): void
    {
        $this->sorting = $sorting;
    }

    /**
     * @return array<int, string>
     */
    public function getRecommendedSpecialties(): array
    {
        return $this->recommendedSpecialties;
    }

    /**
     * @param array<int, string> $recommendedSpecialties
     */
    public function setRecommendedSpecialties(array $recommendedSpecialties): void
    {
        $this->recommendedSpecialties = $recommendedSpecialties;
    }

    public function getLessons(): ObjectStorage
    {
        return $this->lessons;
    }

    public function setLessons(ObjectStorage $lessons): void
    {
        $this->lessons = $lessons;
    }

    public function getInstructor(): ?User
    {
        return $this->instructor;
    }

    public function setInstructor(?User $instructor): void
    {
        $this->instructor = $instructor;
    }

    public function requiresExternalValidation(): bool
    {
        return $this->requiresExternalValidation;
    }

    public function setRequiresExternalValidation(bool $requiresExternalValidation): void
    {
        $this->requiresExternalValidation = $requiresExternalValidation;
    }
}
?>