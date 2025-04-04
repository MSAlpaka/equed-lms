<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Annotation\ORM;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Represents a badge earned by a participant for completing specific actions or achievements.
 *
 * Examples:
 * - 100% theory completed
 * - Specialist in a particular topic
 * - Early submission
 */
class Badge extends AbstractEntity
{
    protected string $name = '';

    protected string $description = '';

    /**
     * Determines if the badge is awarded automatically or manually.
     * Options: 'manual', 'automatic'
     */
    protected string $assignmentType = 'manual';

    /**
     * Badge is linked to this course (optional)
     */
    protected ?Course $relatedCourse = null;

    /**
     * Badge is linked to this lesson (optional)
     */
    protected ?Lesson $relatedLesson = null;

    /**
     * Users who have received this badge
     *
     * @var ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FrontendUser>
     * @ORM\Lazy
     */
    protected ObjectStorage $recipients;

    public function __construct()
    {
        $this->recipients = new ObjectStorage();
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

    public function setRelatedCourse(?Course $course): void
    {
        $this->relatedCourse = $course;
    }

    public function getRelatedLesson(): ?Lesson
    {
        return $this->relatedLesson;
    }

    public function setRelatedLesson(?Lesson $lesson): void
    {
        $this->relatedLesson = $lesson;
    }

    /**
     * @return ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FrontendUser>
     */
    public function getRecipients(): ObjectStorage
    {
        return $this->recipients;
    }

    public function addRecipient(FrontendUser $user): void
    {
        $this->recipients->attach($user);
    }

    public function removeRecipient(FrontendUser $user): void
    {
        $this->recipients->detach($user);
    }
}