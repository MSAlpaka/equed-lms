<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * A learner submission (e.g. report, exam, case).
 * Can be reviewed and connected to a lesson and course record.
 */
class UserSubmission extends AbstractEntity
{
    protected ?FrontendUser $feUser = null;

    protected ?UserCourseRecord $userCourseRecord = null;

    protected ?Lesson $lesson = null;

    /**
     * Submission type (e.g. 'theory_test', 'report', 'practical_case')
     */
    protected string $type = '';

    /**
     * Submission status: submitted, approved, rejected, revision, flagged
     */
    protected string $status = 'submitted';

    /**
     * Optional free-form comment from learner
     */
    protected string $comment = '';

    /**
     * Optional feedback / review note by instructor
     */
    protected string $reviewComment = '';

    /**
     * Optional grade or score (e.g. A+, passed, 80%)
     */
    protected string $grade = '';

    /**
     * Was a resubmission requested?
     */
    protected bool $resubmissionRequired = false;

    /**
     * Date of submission
     */
    protected ?\DateTime $submittedAt = null;

    /**
     * Date of review
     */
    protected ?\DateTime $reviewedAt = null;

    /**
     * Instructor or Certifier who reviewed the submission
     */
    protected ?FrontendUser $reviewedBy = null;

    /**
     * Uploaded files (PDFs, images, etc.)
     *
     * @var ObjectStorage<FileReference>
     */
    protected ObjectStorage $files;

    public function __construct()
    {
        $this->files = new ObjectStorage();
    }

    public function getFeUser(): ?FrontendUser
    {
        return $this->feUser;
    }

    public function setFeUser(?FrontendUser $feUser): void
    {
        $this->feUser = $feUser;
    }

    public function getUserCourseRecord(): ?UserCourseRecord
    {
        return $this->userCourseRecord;
    }

    public function setUserCourseRecord(?UserCourseRecord $record): void
    {
        $this->userCourseRecord = $record;
    }

    public function getLesson(): ?Lesson
    {
        return $this->lesson;
    }

    public function setLesson(?Lesson $lesson): void
    {
        $this->lesson = $lesson;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

    public function getReviewComment(): string
    {
        return $this->reviewComment;
    }

    public function setReviewComment(string $reviewComment): void
    {
        $this->reviewComment = $reviewComment;
    }

    public function getGrade(): string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): void
    {
        $this->grade = $grade;
    }

    public function isResubmissionRequired(): bool
    {
        return $this->resubmissionRequired;
    }

    public function setResubmissionRequired(bool $required): void
    {
        $this->resubmissionRequired = $required;
    }

    public function getSubmittedAt(): ?\DateTime
    {
        return $this->submittedAt;
    }

    public function setSubmittedAt(?\DateTime $submittedAt): void
    {
        $this->submittedAt = $submittedAt;
    }

    public function getReviewedAt(): ?\DateTime
    {
        return $this->reviewedAt;
    }

    public function setReviewedAt(?\DateTime $reviewedAt): void
    {
        $this->reviewedAt = $reviewedAt;
    }

    public function getReviewedBy(): ?FrontendUser
    {
        return $this->reviewedBy;
    }

    public function setReviewedBy(?FrontendUser $reviewedBy): void
    {
        $this->reviewedBy = $reviewedBy;
    }

    /**
     * @return ObjectStorage<FileReference>
     */
    public function getFiles(): ObjectStorage
    {
        return $this->files;
    }

    public function addFile(FileReference $file): void
    {
        $this->files->attach($file);
    }

    public function removeFile(FileReference $file): void
    {
        $this->files->detach($file);
    }
}