<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Represents a Lesson within a Course.
 */
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
     * @var int
     */
    protected int $position = 0;

    /**
     * Zugehöriger Kurs
     *
     * @var Course|null
     */
    protected ?Course $course = null;

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

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    public function getCourse(): ?Course
    {
        return $this->course;
    }

    public function setCourse(?Course $course): void
    {
        $this->course = $course;
    }
}