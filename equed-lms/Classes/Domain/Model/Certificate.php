<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use DateTimeInterface;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;

/**
 * Zertifikat, das nach Abschluss eines Kurses ausgestellt wurde.
 */
class Certificate extends AbstractEntity
{
    /**
     * Eindeutiger Zertifikatscode (z. B. EQD-HC-000123)
     *
     * @var string
     */
    protected string $code = '';

    /**
     * Zugehöriger Kursabschluss (Basis des Zertifikats)
     *
     * @var UserCourseRecord|null
     */
    protected ?UserCourseRecord $userCourseRecord = null;

    /**
     * Aussteller:in des Zertifikats (z. B. Instructor oder Certifier)
     *
     * @var FrontendUser|null
     */
    protected ?FrontendUser $issuedBy = null;

    /**
     * Ausstellungsdatum
     *
     * @var DateTimeInterface|null
     */
    protected ?DateTimeInterface $issuedAt = null;

    /**
     * Status: widerrufen?
     *
     * @var bool
     */
    protected bool $isRevoked = false;

    /**
     * Interne Notiz zur Ausstellung (optional)
     *
     * @var string
     */
    protected string $note = '';

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

    public function getNote(): string
    {
        return $this->note;
    }

    public function setNote(string $note): void
    {
        $this->note = $note;
    }
}