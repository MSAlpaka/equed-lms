<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;

/**
 * Repräsentiert einen Instructor (Ausbilder) im EquEd-LMS.
 *
 * Instructoren sind mit einem FE-User verbunden und können einer Schule, einem Level,
 * bestimmten Spezialisierungen sowie Buchbarkeitsstatus zugewiesen werden.
 */
class Instructor extends AbstractEntity
{
    protected int $pid = 0;

    #[Lazy]
    protected FrontendUser $user;

    #[Lazy]
    protected ?FileReference $image = null;

    protected string $bio = '';

    /**
     * Komma-separierte Specialties, z. B. „donkey,transition“
     */
    protected string $specialties = '';

    protected bool $verified = false;

    /**
     * Instructor-Level: basic, senior, lead …
     */
    protected string $level = 'basic';

    protected bool $canCoTeach = false;

    protected bool $availableForBooking = true;

    #[Lazy]
    protected ?Center $center = null;

    protected ?\DateTimeImmutable $activeSince = null;

    public function getPid(): int
    {
        return $this->pid;
    }

    public function setPid(int $pid): void
    {
        $this->pid = $pid;
    }

    public function getUser(): FrontendUser
    {
        return $this->user;
    }

    public function setUser(FrontendUser $user): void
    {
        $this->user = $user;
    }

    public function getImage(): ?FileReference
    {
        return $this->image;
    }

    public function setImage(?FileReference $image): void
    {
        $this->image = $image;
    }

    public function getBio(): string
    {
        return $this->bio;
    }

    public function setBio(string $bio): void
    {
        $this->bio = $bio;
    }

    public function getSpecialties(): string
    {
        return $this->specialties;
    }

    public function setSpecialties(string $specialties): void
    {
        $this->specialties = $specialties;
    }

    public function isVerified(): bool
    {
        return $this->verified;
    }

    public function setVerified(bool $verified): void
    {
        $this->verified = $verified;
    }

    public function getLevel(): string
    {
        return $this->level;
    }

    public function setLevel(string $level): void
    {
        $this->level = $level;
    }

    public function canCoTeach(): bool
    {
        return $this->canCoTeach;
    }

    public function setCanCoTeach(bool $canCoTeach): void
    {
        $this->canCoTeach = $canCoTeach;
    }

    public function isAvailableForBooking(): bool
    {
        return $this->availableForBooking;
    }

    public function setAvailableForBooking(bool $availableForBooking): void
    {
        $this->availableForBooking = $availableForBooking;
    }

    public function getCenter(): ?Center
    {
        return $this->center;
    }

    public function setCenter(?Center $center): void
    {
        $this->center = $center;
    }

    public function getActiveSince(): ?\DateTimeImmutable
    {
        return $this->activeSince;
    }

    public function setActiveSince(?\DateTimeImmutable $activeSince): void
    {
        $this->activeSince = $activeSince;
    }
}