<?php

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Represents a course offered by EquEd.
 */
class Course extends AbstractEntity
{
    protected string $title = '';

    protected string $description = '';

    protected string $category = ''; // z. B. "Basic", "Specialty", "Instructor"

    protected string $courseCode = ''; // für Zertifikate & Tracking

    protected string $prerequisites = ''; // ggf. künftig als Relation abbilden

    protected int $durationHours = 0;

    protected bool $visible = true;

    protected bool $requiresExternalExaminer = false;

    protected bool $active = true;

    /**
     * @var \Equed\EquedLms\Domain\Model\Center|null
     */
    protected ?Center $center = null;

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

    public function getCourseCode(): string
    {
        return $this->courseCode;
    }

    public function setCourseCode(string $courseCode): void
    {
        $this->courseCode = $courseCode;
    }

    public function getPrerequisites(): string
    {
        return $this->prerequisites;
    }

    public function setPrerequisites(string $prerequisites): void
    {
        $this->prerequisites = $prerequisites;
    }

    public function getDurationHours(): int
    {
        return $this->durationHours;
    }

    public function setDurationHours(int $durationHours): void
    {
        $this->durationHours = $durationHours;
    }

    public function isVisible(): bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): void
    {
        $this->visible = $visible;
    }

    public function isRequiresExternalExaminer(): bool
    {
        return $this->requiresExternalExaminer;
    }

    public function setRequiresExternalExaminer(bool $requiresExternalExaminer): void
    {
        $this->requiresExternalExaminer = $requiresExternalExaminer;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public function getCenter(): ?Center
    {
        return $this->center;
    }

    public function setCenter(?Center $center): void
    {
        $this->center = $center;
    }
}