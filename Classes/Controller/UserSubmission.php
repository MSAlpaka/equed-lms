<?php
declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Equed\EquedLms\Domain\Model\FrontendUser;
use Equed\EquedLms\Domain\Model\CourseInstance;
use Equed\EquedLms\Domain\Model\InstructorFeedback;

class UserSubmission extends AbstractEntity
{
    /**
     * @var FrontendUser|null
     */
    protected ?FrontendUser $user = null;

    /**
     * @var CourseInstance|null
     */
    protected ?CourseInstance $courseInstance = null;

    /**
     * @var string
     */
    protected string $title = '';

    /**
     * @var string
     */
    protected string $submissionType = 'file'; // file, text, url, form

    /**
     * @var string
     */
    protected string $description = '';

    /**
     * @var ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    protected ObjectStorage $files;

    /**
     * @var string
     */
    protected string $textContent = '';

    /**
     * @var string
     */
    protected string $externalUrl = '';

    /**
     * @var string
     */
    protected string $status = 'submitted'; // submitted, in_review, approved, rejected

    /**
     * @var InstructorFeedback|null
     */
    protected ?InstructorFeedback $feedback = null;

    /**
     * @var bool
     */
    protected bool $isRequired = true;

    /**
     * @var bool
     */
    protected bool $isFinal = false;

    /**
     * @var \DateTime|null
     */
    protected ?\DateTime $submittedAt = null;

    /**
     * @var \DateTime|null
     */
    protected ?\DateTime $lastUpdated = null;

    /**
     * @var string
     */
    protected string $uuid = '';

    public function __construct()
    {
        $this->files = new ObjectStorage();
    }

    // === GETTER UND SETTER ===

    public function getUser(): ?FrontendUser
    {
        return $this->user;
    }

    public function setUser(?FrontendUser $user): void
    {
        $this->user = $user;
    }

    public function getCourseInstance(): ?CourseInstance
    {
        return $this->courseInstance;
    }

    public function setCourseInstance(?CourseInstance $courseInstance): void
    {
        $this->courseInstance = $courseInstance;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getSubmissionType(): string
    {
        return $this->submissionType;
    }

    public function setSubmissionType(string $submissionType): void
    {
        $this->submissionType = $submissionType;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getFiles(): ObjectStorage
    {
        return $this->files;
    }

    public function setFiles(ObjectStorage $files): void
    {
        $this->files = $files;
    }

    public function addFile(\TYPO3\CMS\Extbase\Domain\Model\FileReference $file): void
    {
        $this->files->attach($file);
    }

    public function removeFile(\TYPO3\CMS\Extbase\Domain\Model\FileReference $file): void
    {
        $this->files->detach($file);
    }

    public function getTextContent(): string
    {
        return $this->textContent;
    }

    public function setTextContent(string $textContent): void
    {
        $this->textContent = $textContent;
    }

    public function getExternalUrl(): string
    {
        return $this->externalUrl;
    }

    public function setExternalUrl(string $externalUrl): void
    {
        $this->externalUrl = $externalUrl;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getFeedback(): ?InstructorFeedback
    {
        return $this->feedback;
    }

    public function setFeedback(?InstructorFeedback $feedback): void
    {
        $this->feedback = $feedback;
    }

    public function isRequired(): bool
    {
        return $this->isRequired;
    }

    public function setIsRequired(bool $isRequired): void
    {
        $this->isRequired = $isRequired;
    }

    public function isFinal(): bool
    {
        return $this->isFinal;
    }

    public function setIsFinal(bool $isFinal): void
    {
        $this->isFinal = $isFinal;
    }

    public function getSubmittedAt(): ?\DateTime
    {
        return $this->submittedAt;
    }

    public function setSubmittedAt(?\DateTime $submittedAt): void
    {
        $this->submittedAt = $submittedAt;
    }

    public function getLastUpdated(): ?\DateTime
    {
        return $this->lastUpdated;
    }

    public function setLastUpdated(?\DateTime $lastUpdated): void
    {
        $this->lastUpdated = $lastUpdated;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }
}

