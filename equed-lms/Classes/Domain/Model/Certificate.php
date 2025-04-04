<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use DateTimeInterface;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;

/**
 * Represents a certificate issued upon successful course completion.
 * 
 * Contains a unique code, issuing user, date, status, and references to the related record.
 */
class Certificate extends AbstractEntity
{
    /**
     * Unique certificate code (e.g. EQD-HC-000123)
     */
    protected string $code = '';

    /**
     * Associated course record (basis of certification)
     */
    protected ?UserCourseRecord $userCourseRecord = null;

    /**
     * Issued by (Instructor or Certifier)
     */
    protected ?FrontendUser $issuedBy = null;

    /**
     * Issue date
     */
    protected ?DateTimeInterface $issuedAt = null;

    /**
     * Whether the certificate has been revoked
     */
    protected bool $isRevoked = false;

    /**
     * Whether the certificate is verified (vs. provisional)
     */
    protected bool $isVerified = true;

    /**
     * Optional comment by issuer
     */
    protected string $note = '';

    /**
     * Optional PDF certificate file (for download/archive)
     */
    protected ?FileReference $certificateFile = null;

    /**
     * Training center where this certificate was issued (optional)
     */
    protected ?Center $center = null;

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getUserCourseRecord(): ?UserCourseRecord
    {
        return $this->userCourseRecord;
    }

    public function setUserCourseRecord(?UserCourseRecord $userCourseRecord): void
    {
        $this->userCourseRecord = $userCourseRecord;
    }

    public function getIssuedBy(): ?FrontendUser
    {
        return $this->issuedBy;
    }

    public function setIssuedBy(?FrontendUser $issuedBy): void
    {
        $this->issuedBy = $issuedBy;
    }

    public function getIssuedAt(): ?DateTimeInterface
    {
        return $this->issuedAt;
    }

    public function setIssuedAt(?DateTimeInterface $issuedAt): void
    {
        $this->issuedAt = $issuedAt;
    }

    public function isRevoked(): bool
    {
        return $this->isRevoked;
    }

    public function setIsRevoked(bool $isRevoked): void
    {
        $this->isRevoked = $isRevoked;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): void
    {
        $this->isVerified = $isVerified;
    }

    public function getNote(): string
    {
        return $this->note;
    }

    public function setNote(string $note): void
    {
        $this->note = $note;
    }

    public function getCertificateFile(): ?FileReference
    {
        return $this->certificateFile;
    }

    public function setCertificateFile(?FileReference $certificateFile): void
    {
        $this->certificateFile = $certificateFile;
    }

    public function getCenter(): ?Center
    {
        return $this->center;
    }

    public function setCenter(?Center $center): void
    {
        $this->center = $center;
    }
}