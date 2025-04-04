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

    /**
     * Learning outcome / goal (e.g. "HoofCare Specialist")
     */
    protected string $finishGoal = '';

    /**
     * List of course shortnames required to participate
     *
     * @var array<int, string>
     */
    protected array $prerequisites = [];

    /**
     * Optional reference to image or banner for the course
     */
    protected ?FileReference $image = null;

    /**
     * Assigned training center (for validation and administration)
     */
    protected ?Center $center = null;

    /**
     * Determines if this course can lead to a certificate
     */
    protected bool $grantsCertificate = true;

    /**
     * Internal sort order for display in frontend
     */
    protected int $sorting = 0;

    /**
     * Optional array of recommended follow-up specialties
     *
     * @var array<int, string>
     */
    protected array $recommendedSpecialties = [];

    /**
     * Lessons assigned to this course
     *
     * @var ObjectStorage<Lesson>
     */
    protected ObjectStorage $lessons;

    public function __construct()
    {
        $this->lessons = new ObjectStorage();
    }

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

    public function isGrantsCertificate(): bool
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

    /**
     * @return ObjectStorage<Lesson>
     */
    public function getLessons(): ObjectStorage
    {
        return $this->lessons;
    }

    /**
     * @param ObjectStorage<Lesson> $lessons
     */
    public function setLessons(ObjectStorage $lessons): void
    {
        $this->lessons = $lessons;
    }

    public function addLesson(Lesson $lesson): void
    {
        $this->lessons->attach($lesson);
    }

    public function removeLesson(Lesson $lesson): void
    {
        $this->lessons->detach($lesson);
    }
}