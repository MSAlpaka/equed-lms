<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;

/**
 * Represents an instructor in the EquEd LMS.
 * 
 * Instructors can be assigned to centers, courses and learners. They can be verified and filtered by specialty or availability.
 */
class Instructor extends AbstractEntity
{
    /**
     * Associated frontend user
     */
    protected FrontendUser $user;

    /**
     * Optional profile image
     */
    protected ?FileReference $image = null;

    /**
     * Freitext-Biografie oder Vorstellung
     */
    protected string $bio = '';

    /**
     * Komma-separierte Specialties (e.g. "donkey,transition")
     */
    protected string $specialties = '';

    /**
     * Ist der Instructor offiziell verifiziert?
     */
    protected bool $verified = false;

    /**
     * Instructor level (e.g. basic, senior, lead)
     */
    protected string $level = 'basic';

    /**
     * Darf co-teaching durchführen
     */
    protected bool $canCoTeach = false;

    /**
     * Optional: Verfügbar für neue Buchungen
     */
    protected bool $availableForBooking = true;

    /**
     * Ausbildungszentrum, dem der Instructor zugewiesen ist
     */
    protected ?Center $center = null;

    /**
     * Datum des Instructor-Status
     */
    protected ?\DateTime $activeSince = null;

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

    public function isCanCoTeach(): bool
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

    public function getActiveSince(): ?\DateTime
    {
        return $this->activeSince;
    }

    public function setActiveSince(?\DateTime $activeSince): void
    {
        $this->activeSince = $activeSince;
    }
}