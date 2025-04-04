<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Represents a single content page within a lesson.
 * 
 * May contain HTML content, media, downloadable files, or be linked to a quiz question.
 */
class ContentPage extends AbstractEntity
{
    protected string $title = '';

    protected string $text = '';

    protected int $position = 0;

    protected ?Lesson $lesson = null;

    /**
     * Indicates whether the learner has to mark this page as read to progress
     */
    protected bool $isRequired = true;

    /**
     * Linked quiz question (optional)
     */
    protected ?QuizQuestion $quizQuestion = null;

    /**
     * Media files displayed on this page
     *
     * @var ObjectStorage<FileReference>
     */
    protected ObjectStorage $media;

    /**
     * Optional files for download (e.g. PDFs, worksheets)
     *
     * @var ObjectStorage<FileReference>
     */
    protected ObjectStorage $downloads;

    public function __construct()
    {
        $this->media = new ObjectStorage();
        $this->downloads = new ObjectStorage();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    public function getLesson(): ?Lesson
    {
        return $this->lesson;
    }

    public function setLesson(?Lesson $lesson): void
    {
        $this->lesson = $lesson;
    }

    public function isRequired(): bool
    {
        return $this->isRequired;
    }

    public function setIsRequired(bool $isRequired): void
    {
        $this->isRequired = $isRequired;
    }

    public function getQuizQuestion(): ?QuizQuestion
    {
        return $this->quizQuestion;
    }

    public function setQuizQuestion(?QuizQuestion $quizQuestion): void
    {
        $this->quizQuestion = $quizQuestion;
    }

    /**
     * @return ObjectStorage<FileReference>
     */
    public function getMedia(): ObjectStorage
    {
        return $this->media;
    }

    public function addMedia(FileReference $file): void
    {
        $this->media->attach($file);
    }

    public function removeMedia(FileReference $file): void
    {
        $this->media->detach($file);
    }

    /**
     * @return ObjectStorage<FileReference>
     */
    public function getDownloads(): ObjectStorage
    {
        return $this->downloads;
    }

    public function addDownload(FileReference $file): void
    {
        $this->downloads->attach($file);
    }

    public function removeDownload(FileReference $file): void
    {
        $this->downloads->detach($file);
    }
}