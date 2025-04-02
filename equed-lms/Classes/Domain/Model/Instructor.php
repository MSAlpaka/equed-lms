<?php

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;

/**
 * Represents an instructor in the LMS.
 */
class Instructor extends AbstractEntity
{
    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
     */
    protected FrontendUser $user;

    /**
     * @var string Freitext-Biografie oder Vorstellung
     */
    protected string $bio = '';

    /**
     * @var string Komma-separierte Specialties (z. B. "donkey,transition")
     */
    protected string $specialties = '';

    /**
     * @var bool Ist der Instructor offiziell verifiziert?
     */
    protected bool $verified = false;

    public function getUser(): FrontendUser
    {
        return $this->user;
    }

    public function setUser(FrontendUser $user): void
    {
        $this->user = $user;
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
}