<?php

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use Equed\EquedLms\Domain\Model\Course;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;

/**
 * Represents a user submission (e.g. for exams, reports, documents).
 */
class UserSubmission extends AbstractEntity
{
    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
     */
    protected FrontendUser $user;

    /**
     * @var \Equed\EquedLms\Domain\Model\Course
     */
    protected Course $course;

    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference|null
     */
    protected ?FileReference $file = null;

    /**
     * @var string
     */
    protected string $comment = '';

    /**
     * @var string Status of submission: 'submitted', 'reviewed', 'rejected', 'approved'
     */
    protected string $status = 'submitted';

    /**
     * @var \DateTime|null
     */
    protected ?\DateTime $submittedAt = null;

    public function getUser(): FrontendUser
    {
        return $this->user;
    }

    public function setUser(FrontendUser $user): void
    {
        $this->user = $user;
    }

    public function getCourse(): Course
    {
        return $this->course;
    }

    public function setCourse(Course $course): void
    {
        $this->course = $course;
    }

    public function getFile(): ?FileReference
    {
        return $this->file;
    }

    public function setFile(?FileReference $file): void
    {
        $this->file = $file;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getSubmittedAt(): ?\DateTime
    {
        return $this->submittedAt;
    }

    public function setSubmittedAt(?\DateTime $submittedAt): void
    {
        $this->submittedAt = $submittedAt;
    }
}