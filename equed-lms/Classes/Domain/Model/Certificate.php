<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;

/**
 * Zertifikat nach erfolgreichem Kursabschluss.
 */
class Certificate extends AbstractEntity
{
    protected int $pid = 0;

    protected string $code = '';

    #[Lazy]
    protected ?UserCourseRecord $userCourseRecord = null;

    #[Lazy]
    protected ?FrontendUser $issuedBy = null;

    protected ?\DateTimeImmutable $issuedAt = null;

    protected bool $isRevoked = false;
    protected bool $isVerified = true;

    protected string $note = '';

    public function getPid(): int { return $this->pid; }

    public function getCode(): string { return $this->code; }
    public function setCode(string $code): void { $this->code = $code; }

    public function getUserCourseRecord(): ?UserCourseRecord { return $this->userCourseRecord; }
    public function setUserCourseRecord(?UserCourseRecord $record): void { $this->userCourseRecord = $record; }

    public function getIssuedBy(): ?FrontendUser { return $this->issuedBy; }
    public function setIssuedBy(?FrontendUser $user): void { $this->issuedBy = $user; }

    public function getIssuedAt(): ?\DateTimeImmutable { return $this->issuedAt; }
    public function setIssuedAt(?\DateTimeImmutable $date): void { $this->issuedAt = $date; }

    public function isRevoked(): bool { return $this->isRevoked; }
    public function setIsRevoked(bool $revoked): void { $this->isRevoked = $revoked; }

    public function isVerified(): bool { return $this->isVerified; }
    public function setIsVerified(bool $verified): void { $this->isVerified = $verified; }

    public function getNote(): string { return $this->note; }
    public function setNote(string $note): void { $this->note = $note; }
}