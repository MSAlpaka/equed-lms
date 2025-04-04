<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * This class represents a Course in the EquEd LMS.
 */
class Course extends AbstractEntity
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
     * @var string
     */
    protected string $category = '';

    /**
     * @var bool
     */
    protected bool $isActive = true;

    /**
     * Abschlussziel für die Zertifizierung (z. B. "HoofCare Specialist")
     *
     * @var string
     */
    protected string $finishGoal = '';

    /**
     * Voraussetzungskürzel (z. B. ['hoofcare_basic'])
     *
     * @var array<int, string>
     */
    protected array $prerequisites = [];

    /**
     * Zugeordnete Lektionen (bidirektional: Lesson.course)
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

    public function isIsActive(): bool
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