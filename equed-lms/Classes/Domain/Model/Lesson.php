<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Represents a single lesson within a course.
 *
 * Lessons contain pages and optionally quiz questions and materials.
 */
class Lesson extends AbstractEntity
{
    protected string $title = '';

    protected string $slug = '';

    /**
     * Short description of the lesson content
     */
    protected string $description = '';

    /**
     * Position in course (sorting)
     */
    protected int $position = 0;

    /**
     * Optional estimated duration in minutes
     */
    protected int $durationInMinutes = 0;

    /**
     * Is this lesson mandatory to complete the course?
     */
    protected bool $isRequired = true;

    /**
     * Associated course
     */
    protected ?Course $course = null;

    /**
     * Content pages (text, media, downloads)
     *
     * @var ObjectStorage<ContentPage>
     */
    protected ObjectStorage $pages;

    /**
     * Optional quiz questions assigned to this lesson
     *
     * @var ObjectStorage<QuizQuestion>
     */
    protected ObjectStorage $quizQuestions;

    /**
     * Optional downloadable files (e.g. worksheets)
     *
     * @var ObjectStorage<FileReference>
     */
    protected ObjectStorage $materials;

    public function __construct()
    {
        $this->pages = new ObjectStorage();
        $this->quizQuestions = new ObjectStorage();
        $this->materials = new ObjectStorage();
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

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    public function getDurationInMinutes(): int
    {
        return $this->durationInMinutes;
    }

    public function setDurationInMinutes(int $durationInMinutes): void
    {
        $this->durationInMinutes = $durationInMinutes;
    }

    public function isRequired(): bool
    {
        return $this->isRequired;
    }

    public function setIsRequired(bool $isRequired): void
    {
        $this->isRequired = $isRequired;
    }

    public function getCourse(): ?Course
    {
        return $this->course;
    }

    public function setCourse(?Course $course): void
    {
        $this->course = $course;
    }

    /**
     * @return ObjectStorage<ContentPage>
     */
    public function getPages(): ObjectStorage
    {
        return $this->pages;
    }

    public function addPage(ContentPage $page): void
    {
        $this->pages->attach($page);
    }

    public function removePage(ContentPage $page): void
    {
        $this->pages->detach($page);
    }

    /**
     * @return ObjectStorage<QuizQuestion>
     */
    public function getQuizQuestions(): ObjectStorage
    {
        return $this->quizQuestions;
    }

    public function addQuizQuestion(QuizQuestion $question): void
    {
        $this->quizQuestions->attach($question);
    }

    public function removeQuizQuestion(QuizQuestion $question): void
    {
        $this->quizQuestions->detach($question);
    }

    /**
     * @return ObjectStorage<FileReference>
     */
    public function getMaterials(): ObjectStorage
    {
        return $this->materials;
    }

    public function addMaterial(FileReference $file): void
    {
        $this->materials->attach($file);
    }

    public function removeMaterial(FileReference $file): void
    {
        $this->materials->detach($file);
    }
}