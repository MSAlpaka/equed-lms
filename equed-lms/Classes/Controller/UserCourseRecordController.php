<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;

/**
 * Kursverlauf eines Teilnehmenden für eine konkrete Kursdurchführung.
 * Enthält Prüfungsstatus, Fortschritt und Zertifikatsinformationen.
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

    protected string $status = 'in_progress'; // in_progress, completed, failed, withdrawn

    protected int $attemptCount = 1;
    protected bool $isRetake = false;

    protected bool $instructorConfirmed = false;
    protected bool $certifierValidated = false;
    protected bool $adminApproved = false;

    protected string $instructorFeedback = '';
    protected string $note = '';
    protected string $examResults = '';

    protected string $certificateCode = '';
    protected ?\DateTimeImmutable $certificateIssuedAt = null;

    public function getUser(): FrontendUser { return $this->user; }
    public function setUser(FrontendUser $user): void { $this->user = $user; }

    public function getCourseInstance(): CourseInstance { return $this->courseInstance; }
    public function setCourseInstance(CourseInstance $ci): void { $this->courseInstance = $ci; }

    public function getInstructor(): ?FrontendUser { return $this->instructor; }
    public function setInstructor(?FrontendUser $instructor): void { $this->instructor = $instructor; }

    public function getStartedAt(): ?\DateTimeImmutable { return $this->startedAt; }
    public function setStartedAt(?\DateTimeImmutable $value): void { $this->startedAt = $value; }

    public function getCompletedAt(): ?\DateTimeImmutable { return $this->completedAt; }
    public function setCompletedAt(?\DateTimeImmutable $value): void { $this->completedAt = $value; }

    public function getStatus(): string { return $this->status; }
    public function setStatus(string $status): void { $this->status = $status; }

    public function getAttemptCount(): int { return $this->attemptCount; }
    public function setAttemptCount(int $count): void { $this->attemptCount = $count; }

    public function isRetake(): bool { return $this->isRetake; }
    public function setIsRetake(bool $retake): void { $this->isRetake = $retake; }

    public function isInstructorConfirmed(): bool { return $this->instructorConfirmed; }
    public function setInstructorConfirmed(bool $flag): void { $this->instructorConfirmed = $flag; }

    public function isCertifierValidated(): bool { return $this->certifierValidated; }
    public function setCertifierValidated(bool $flag): void { $this->certifierValidated = $flag; }

    public function isAdminApproved(): bool { return $this->adminApproved; }
    public function setAdminApproved(bool $flag): void { $this->adminApproved = $flag; }

    public function getInstructorFeedback(): string { return $this->instructorFeedback; }
    public function setInstructorFeedback(string $text): void { $this->instructorFeedback = $text; }

    public function getNote(): string { return $this->note; }
    public function setNote(string $note): void { $this->note = $note; }

    public function getExamResults(): string { return $this->examResults; }
    public function setExamResults(string $results): void { $this->examResults = $results; }

    public function getCertificateCode(): string { return $this->certificateCode; }
    public function setCertificateCode(string $code): void { $this->certificateCode = $code; }

    public function getCertificateIssuedAt(): ?\DateTimeImmutable { return $this->certificateIssuedAt; }
    public function setCertificateIssuedAt(?\DateTimeImmutable $date): void { $this->certificateIssuedAt = $date; }
}