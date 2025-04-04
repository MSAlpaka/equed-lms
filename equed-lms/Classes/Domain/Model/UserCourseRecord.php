<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;

class UserCourseRecord extends AbstractEntity
{
    /**
     * @var \Equed\EquedLms\Domain\Model\CourseInstance
     * @Lazy
     */
    protected $courseInstance;

    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
     * @Lazy
     */
    protected $user;

    /**
     * @var \Equed\EquedLms\Domain\Model\FrontendUser|null
     * @Lazy
     */
    protected $instructor;

    /**
     * @var \DateTime|null
     */
    protected $startedAt;

    /**
     * @var \DateTime|null
     */
    protected $completedAt;

    /**
     * @var bool
     */
    protected $instructorConfirmed = false;

    /**
     * @var bool
     */
    protected $certifierValidated = false;

    /**
     * @var bool
     */
    protected $adminApproved = false;

    /**
     * @var string
     */
    protected $certificateCode = '';

    /**
     * @var \DateTime|null
     */
    protected $certificateIssuedAt;

    /**
     * @var string
     */
    protected $status = 'in_progress'; // z. B. in_progress, failed, passed, validated

    /**
     * @var string
     */
    protected $metaJson = ''; // Optionales Zusatzfeld für spätere Daten

    // --- GETTER & SETTER ---

    public function getCourseInstance(): ?CourseInstance
    {
        return $this->courseInstance;
    }

    public function setCourseInstance(?CourseInstance $courseInstance): void
    {
        $this->courseInstance = $courseInstance;
    }

    public function getUser(): ?\TYPO3\CMS\Extbase\Domain\Model\FrontendUser
    {
        return $this->user;
    }

    public function setUser(?\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $user): void
    {
        $this->user = $user;
    }

    public function getInstructor(): ?\Equed\EquedLms\Domain\Model\FrontendUser
    {
        return $this->instructor;
    }

    public function setInstructor(?\Equed\EquedLms\Domain\Model\FrontendUser $instructor): void
    {
        $this->instructor = $instructor;
    }

    public function getStartedAt(): ?\DateTime
    {
        return $this->startedAt;
    }

    public function setStartedAt(?\DateTime $startedAt): void
    {
        $this->startedAt = $startedAt;
    }

    public function getCompletedAt(): ?\DateTime
    {
        return $this->completedAt;
    }

    public function setCompletedAt(?\DateTime $completedAt): void
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

    public function getCertificateIssuedAt(): ?\DateTime
    {
        return $this->certificateIssuedAt;
    }

    public function setCertificateIssuedAt(?\DateTime $certificateIssuedAt): void
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