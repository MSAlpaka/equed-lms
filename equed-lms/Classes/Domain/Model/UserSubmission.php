<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;

/**
 * Eine eingereichte Prüfungs- oder Lernleistung durch Teilnehmende.
 *
 * Kann Berichte, Tests, Fallstudien etc. enthalten. Bewertet durch eine prüfende Person.
 */
class UserSubmission extends AbstractEntity
{
    protected int $pid = 0;

    #[Lazy]
    protected ?FrontendUser $feUser = null;

    #[Lazy]
    protected ?UserCourseRecord $userCourseRecord = null;

    #[Lazy]
    protected ?Lesson $lesson = null;

    /**
     * Typ der Einreichung (z. B. 'theory_test', 'report', 'practical_case')
     */
    protected string $type = '';

    /**
     * Status: submitted, approved, rejected, revision, flagged
     */
    protected string $status = 'submitted';

    protected string $comment = '';

    protected string $reviewComment = '';

    protected string $grade = '';

    protected bool $resubmissionRequired = false;

    protected ?\DateTimeImmutable $submittedAt = null;

    protected ?\DateTimeImmutable $reviewedAt = null;

    #[Lazy]
    protected ?FrontendUser $reviewedBy = null;

    /**
     * @var ObjectStorage<FileReference>
     */
    #[Lazy]
    protected ObjectStorage $files;

    public function __construct()
    {
        $this->files = new ObjectStorage();
    }

    public function getPid(): int
    {
        return $this->pid;
    }

    public function setPid(int $pid): void
    {
        $this->pid = $pid;
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

    public function setUserCourseRecord(?UserCourseRecord $userCourseRecord): void
    {
        $this->userCourseRecord = $userCourseRecord;
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

    public function setResubmissionRequired(bool $resubmissionRequired): void
    {
        $this->resubmissionRequired = $resubmissionRequired;
    }

    public function getSubmittedAt(): ?\DateTimeImmutable
    {
        return $this->submittedAt;
    }

    public function setSubmittedAt(?\DateTimeImmutable $submittedAt): void
    {
        $this->submittedAt = $submittedAt;
    }

    public function getReviewedAt(): ?\DateTimeImmutable
    {
        return $this->reviewedAt;
    }

    public function setReviewedAt(?\DateTimeImmutable $reviewedAt): void
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