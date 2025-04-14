<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;

/**
 * Definiert ein übergeordnetes Kursprogramm mit Zielen, Voraussetzungen und Zertifizierungsart.
 * Einzelne Kursdurchführungen erfolgen als CourseInstance.
 */
class CourseProgram extends AbstractEntity
{
    protected int $pid = 0;

    protected string $title = '';

    protected string $slug = '';

    protected string $description = '';

    protected string $certification = '';

    protected int $duration = 0; // Dauer in Stunden

    protected string $requirements = '';

    protected string $goals = '';

    /**
     * @var ObjectStorage<CourseInstance>
     */
    #[Lazy]
    protected ObjectStorage $instances;

    public function __construct()
    {
        $this->instances = new ObjectStorage();
    }

    public function getPid(): int
    {
        return $this->pid;
    }

    public function setPid(int $pid): void
    {
        $this->pid = $pid;
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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getCertification(): string
    {
        return $this->certification;
    }

    public function setCertification(string $certification): void
    {
        $this->certification = $certification;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): void
    {
        $this->duration = $duration;
    }

    public function getRequirements(): string
    {
        return $this->requirements;
    }

    public function setRequirements(string $requirements): void
    {
        $this->requirements = $requirements;
    }

    public function getGoals(): string
    {
        return $this->goals;
    }

    public function setGoals(string $goals): void
    {
        $this->goals = $goals;
    }

    public function getInstances(): ObjectStorage
    {
        return $this->instances;
    }

    public function addInstance(CourseInstance $instance): void
    {
        $this->instances->attach($instance);
    }

    public function removeInstance(CourseInstance $instance): void
    {
        $this->instances->detach($instance);
    }
}