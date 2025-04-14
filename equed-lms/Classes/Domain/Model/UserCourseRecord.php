<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;

/**
 * Verknüpfung eines Teilnehmenden mit einer konkreten Kursdurchführung.
 * Enthält Fortschritts-, Bewertungs- und Zertifizierungsdaten.
 */
class UserCourseRecord extends AbstractEntity
{
    protected int $pid = 0;

    #[Lazy]
    protected CourseInstance $courseInstance;

    #[Lazy]
    protected FrontendUser $user;

    #[Lazy]
    protected ?FrontendUser $instructor = null;

    protected ?\DateTimeImmutable $startedAt = null;

    protected ?\DateTimeImmutable $completedAt = null;

    protected bool $instructorConfirmed = false;

    protected bool $certifierValidated = false;

    protected bool $adminApproved = false;

    protected string $certificateCode = '';

    protected ?\DateTimeImmutable $certificateIssuedAt = null;

    protected string $status = 'in_progress';

    protected string $metaJson = '';

    // Getter & Setter

    public function getPid(): int
    {
        return $this->pid;
    }

    public function setPid(int $pid): void
    {
        $this->pid = $pid;
    }

    public function getCourseInstance(): CourseInstance
    {
        return $this->courseInstance;
    }

    public function setCourseInstance(CourseInstance $courseInstance): void
    {
        $this->courseInstance = $courseInstance;
    }

    public function getUser(): FrontendUser
    {
        return $this->user;
    }

    public function setUser(FrontendUser $user): void
    {
        $this->user = $user;
    }

    public function getInstructor(): ?FrontendUser
    {
        return $this->instructor;
    }

    public function setInstructor(?FrontendUser $instructor): void
    {
        $this->instructor = $instructor;
    }

    public function hasInstructor(): bool
    {
        return $this->instructor !== null;
    }

    public function getStartedAt(): ?\DateTimeImmutable
    {
        return $this->startedAt;
    }

    public function setStartedAt(?\DateTimeImmutable $startedAt): void
    {
        $this->startedAt = $startedAt;
    }

    public function getCompletedAt(): ?\DateTimeImmutable
    {
        return $this->completedAt;
    }

    public function setCompletedAt(?\DateTimeImmutable $completedAt): void
    {
        $this->completedAt = $completedAt;
    }

    public function isInstructorConfirmed(): bool
    {
        return $this->instructorConfirmed;
    }

    public function setInstructorConfirmed(bool $instructorConfirmed): void
    {
        $this->instructorConfirmed = $instructorConfirmed;
    }

    public function isCertifierValidated(): bool
    {
        return $this->certifierValidated;
    }

    public function setCertifierValidated(bool $certifierValidated): void
    {
        $this->certifierValidated = $certifierValidated;
    }

    public function isAdminApproved(): bool
    {
        return $this->adminApproved;
    }

    public function setAdminApproved(bool $adminApproved): void
    {
        $this->adminApproved = $adminApproved;
    }

    public function getCertificateCode(): string
    {
        return $this->certificateCode;
    }

    public function setCertificateCode(string $certificateCode): void
    {
        $this->certificateCode = $certificateCode;
    }

    public function getCertificateIssuedAt(): ?\DateTimeImmutable
    {
        return $this->certificateIssuedAt;
    }

    public function setCertificateIssuedAt(?\DateTimeImmutable $certificateIssuedAt): void
    {
        $this->certificateIssuedAt = $certificateIssuedAt;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getMetaJson(): string
    {
        return $this->metaJson;
    }

    public function setMetaJson(string $metaJson): void
    {
        $this->metaJson = $metaJson;
    }
}