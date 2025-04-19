<?php
declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use Equed\EquedLms\Domain\Model\FrontendUser;
use Equed\EquedLms\Domain\Model\CourseInstance;
use Equed\EquedLms\Domain\Model\CertificateDesign;

class CourseCertificate extends AbstractEntity
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
    protected string $certificateCode = '';

    /**
     * @var string
     */
    protected string $status = 'issued'; // issued, revoked, prepared, expired

    /**
     * @var bool
     */
    protected bool $isValid = true;

    /**
     * @var bool
     */
    protected bool $visibleForUser = true;

    /**
     * @var \DateTime|null
     */
    protected ?\DateTime $issuedAt = null;

    /**
     * @var \DateTime|null
     */
    protected ?\DateTime $validatedAt = null;

    /**
     * @var \DateTime|null
     */
    protected ?\DateTime $dispatchedAt = null;

    /**
     * @var FrontendUser|null
     */
    protected ?FrontendUser $issuedBy = null;

    /**
     * @var FrontendUser|null
     */
    protected ?FrontendUser $validatedBy = null;

    /**
     * @var FrontendUser|null
     */
    protected ?FrontendUser $dispatchedBy = null;

    /**
     * @var string
     */
    protected string $pdfUrl = ''; // Pfad zur gespeicherten Zertifikats-PDF

    /**
     * @var CertificateDesign|null
     */
    protected ?CertificateDesign $certificateDesign = null;

    /**
     * @var string
     */
    protected string $uuid = '';

    /**
     * @var \DateTime|null
     */
    protected ?\DateTime $createdAt = null;

    /**
     * @var \DateTime|null
     */
    protected ?\DateTime $updatedAt = null;

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

    public function getCertificateCode(): string
    {
        return $this->certificateCode;
    }

    public function setCertificateCode(string $certificateCode): void
    {
        $this->certificateCode = $certificateCode;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function isValid(): bool
    {
        return $this->isValid;
    }

    public function setIsValid(bool $isValid): void
    {
        $this->isValid = $isValid;
    }

    public function isVisibleForUser(): bool
    {
        return $this->visibleForUser;
    }

    public function setVisibleForUser(bool $visibleForUser): void
    {
        $this->visibleForUser = $visibleForUser;
    }

    public function getIssuedAt(): ?\DateTime
    {
        return $this->issuedAt;
    }

    public function setIssuedAt(?\DateTime $issuedAt): void
    {
        $this->issuedAt = $issuedAt;
    }

    public function getValidatedAt(): ?\DateTime
    {
        return $this->validatedAt;
    }

    public function setValidatedAt(?\DateTime $validatedAt): void
    {
        $this->validatedAt = $validatedAt;
    }

    public function getDispatchedAt(): ?\DateTime
    {
        return $this->dispatchedAt;
    }

    public function setDispatchedAt(?\DateTime $dispatchedAt): void
    {
        $this->dispatchedAt = $dispatchedAt;
    }

    public function getIssuedBy(): ?FrontendUser
    {
        return $this->issuedBy;
    }

    public function setIssuedBy(?FrontendUser $issuedBy): void
    {
        $this->issuedBy = $issuedBy;
    }

    public function getValidatedBy(): ?FrontendUser
    {
        return $this->validatedBy;
    }

    public function setValidatedBy(?FrontendUser $validatedBy): void
    {
        $this->validatedBy = $validatedBy;
    }

    public function getDispatchedBy(): ?FrontendUser
    {
        return $this->dispatchedBy;
    }

    public function setDispatchedBy(?FrontendUser $dispatchedBy): void
    {
        $this->dispatchedBy = $dispatchedBy;
    }

    public function getPdfUrl(): string
    {
        return $this->pdfUrl;
    }

    public function setPdfUrl(string $pdfUrl): void
    {
        $this->pdfUrl = $pdfUrl;
    }

    public function getCertificateDesign(): ?CertificateDesign
    {
        return $this->certificateDesign;
    }

    public function setCertificateDesign(?CertificateDesign $certificateDesign): void
    {
        $this->certificateDesign = $certificateDesign;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}

