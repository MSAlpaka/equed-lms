<?php

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;

/**
 * Represents a single lesson in a course.
 */
class Lesson extends AbstractEntity
{
    protected string $title = '';

    protected string $content = '';

    protected int $sortOrder = 0;

    protected int $estimatedTime = 0; // minutes

    protected bool $required = false;

    protected bool $visible = true;

    /**
     * @var \Equed\EquedLms\Domain\Model\Course
     */
    protected Course $course;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @Cascade("remove")
     */
    protected ObjectStorage $mediaFiles;

    public function __construct()
    {
        $this->mediaFiles = new ObjectStorage();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getSortOrder(): int
    {
        return $this->sortOrder;
    }

    public function setSortOrder(int $sortOrder): void
    {
        $this->sortOrder = $sortOrder;
    }

    public function getEstimatedTime(): int
    {
        return $this->estimatedTime;
    }

    public function setEstimatedTime(int $estimatedTime): void
    {
        $this->estimatedTime = $estimatedTime;
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function setRequired(bool $required): void
    {
        $this->required = $required;
    }

    public function isVisible(): bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): void
    {
        $this->visible = $visible;
    }

    public function getCourse(): Course
    {
        return $this->course;
    }

    public function setCourse(Course $course): void
    {
        $this->course = $course;
    }

    public function getMediaFiles(): ObjectStorage
    {
        return $this->mediaFiles;
    }

    public function addMediaFile(FileReference $mediaFile): void
    {
        $this->mediaFiles->attach($mediaFile);
    }

    public function removeMediaFile(FileReference $mediaFile): void
    {
        $this->mediaFiles->detach($mediaFile);
    }
}