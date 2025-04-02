<?php

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;

/**
 * Represents a content block/page in a lesson or course.
 */
class ContentPage extends AbstractEntity
{
    protected string $title = '';

    protected string $content = '';

    protected int $sorting = 0;

    protected bool $visible = true;

    /**
     * @var \Equed\EquedLms\Domain\Model\Course|null
     */
    protected ?Course $course = null;

    /**
     * @var \Equed\EquedLms\Domain\Model\Lesson|null
     */
    protected ?Lesson $lesson = null;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    protected ObjectStorage $attachments;

    public function __construct()
    {
        $this->attachments = new ObjectStorage();
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

    public function getSorting(): int
    {
        return $this->sorting;
    }

    public function setSorting(int $sorting): void
    {
        $this->sorting = $sorting;
    }

    public function isVisible(): bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): void
    {
        $this->visible = $visible;
    }

    public function getCourse(): ?Course
    {
        return $this->course;
    }

    public function setCourse(?Course $course): void
    {
        $this->course = $course;
    }

    public function getLesson(): ?Lesson
    {
        return $this->lesson;
    }

    public function setLesson(?Lesson $lesson): void
    {
        $this->lesson = $lesson;
    }

    public function getAttachments(): ObjectStorage
    {
        return $this->attachments;
    }

    public function addAttachment(FileReference $file): void
    {
        $this->attachments->attach($file);
    }

    public function removeAttachment(FileReference $file): void
    {
        $this->attachments->detach($file);
    }
}