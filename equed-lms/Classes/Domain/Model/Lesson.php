<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Einzelne Lektion innerhalb eines Kurses.
 *
 * Eine Lesson enthält Inhaltsseiten und optional Quizfragen oder Materialien.
 */
class Lesson extends AbstractEntity
{
    protected int $pid = 0;

    protected string $title = '';

    protected string $slug = '';

    /**
     * Kurzbeschreibung des Inhalts
     */
    protected string $description = '';

    /**
     * Position innerhalb des Kurses
     */
    protected int $position = 0;

    /**
     * Optionale geschätzte Dauer in Minuten
     */
    protected int $durationInMinutes = 0;

    /**
     * Muss diese Lektion abgeschlossen werden, um den Kurs zu bestehen?
     */
    protected bool $isRequired = true;

    #[Lazy]
    protected ?Course $course = null;

    /**
     * @var ObjectStorage<ContentPage>
     */
    #[Lazy]
    protected ObjectStorage $pages;

    /**
     * @var ObjectStorage<QuizQuestion>
     */
    #[Lazy]
    protected ObjectStorage $quizQuestions;

    /**
     * @var ObjectStorage<FileReference>
     */
    #[Lazy]
    protected ObjectStorage $materials;

    public function __construct()
    {
        $this->pages = new ObjectStorage();
        $this->quizQuestions = new ObjectStorage();
        $this->materials = new ObjectStorage();
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

    public function getQuizQuestions(): ObjectStorage
    {
        return $this->quizQuestions;
    }

    public function addQuizQuestion(QuizQuestion $quizQuestion): void
    {
        $this->quizQuestions->attach($quizQuestion);
    }

    public function removeQuizQuestion(QuizQuestion $quizQuestion): void
    {
        $this->quizQuestions->detach($quizQuestion);
    }

    public function getMaterials(): ObjectStorage
    {
        return $this->materials;
    }

    public function addMaterial(FileReference $material): void
    {
        $this->materials->attach($material);
    }

    public function removeMaterial(FileReference $material): void
    {
        $this->materials->detach($material);
    }
}