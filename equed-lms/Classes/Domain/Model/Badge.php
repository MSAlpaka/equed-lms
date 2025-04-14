<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;

/**
 * Badge – Auszeichnung für besondere Leistungen im LMS.
 *
 * Beispiele:
 * - 100 % Theorielektionen abgeschlossen
 * - Frühzeitige Abgabe eines Berichts
 * - Spezialisierung in einem bestimmten Thema
 */
class Badge extends AbstractEntity
{
    protected int $pid = 0;

    protected string $name = '';

    protected string $description = '';

    /**
     * Vergabeart: 'manual' oder 'automatic'
     */
    protected string $assignmentType = 'manual';

    #[Lazy]
    protected ?Course $relatedCourse = null;

    #[Lazy]
    protected ?Lesson $relatedLesson = null;

    /**
     * @var ObjectStorage<FrontendUser>
     */
    #[Lazy]
    protected ObjectStorage $recipients;

    public function __construct()
    {
        $this->recipients = new ObjectStorage();
    }

    public function getPid(): int
    {
        return $this->pid;
    }

    public function setPid(int $pid): void
    {
        $this->pid = $pid;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getAssignmentType(): string
    {
        return $this->assignmentType;
    }

    public function setAssignmentType(string $assignmentType): void
    {
        $this->assignmentType = $assignmentType;
    }

    public function getRelatedCourse(): ?Course
    {
        return $this->relatedCourse;
    }

    public function setRelatedCourse(?Course $relatedCourse): void
    {
        $this->relatedCourse = $relatedCourse;
    }

    public function getRelatedLesson(): ?Lesson
    {
        return $this->relatedLesson;
    }

    public function setRelatedLesson(?Lesson $relatedLesson): void
    {
        $this->relatedLesson = $relatedLesson;
    }

    public function getRecipients(): ObjectStorage
    {
        return $this->recipients;
    }

    public function addRecipient(FrontendUser $recipient): void
    {
        $this->recipients->attach($recipient);
    }

    public function removeRecipient(FrontendUser $recipient): void
    {
        $this->recipients->detach($recipient);
    }
}