<?php
namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Center Model für die Verwaltung der Ausbildungszentren
 */
class Center extends AbstractEntity
{
    protected string $name = '';
    protected string $street = '';
    protected string $zip = '';
    protected string $city = '';
    protected string $website = '';
    protected string $centerId = '';
    protected string $logo = '';
    protected int $certifier = 0; // NEU: Zuständiger FE-User

    // Getter und Setter

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    public function getZip(): string
    {
        return $this->zip;
    }

    public function setZip(string $zip): void
    {
        $this->zip = $zip;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getWebsite(): string
    {
        return $this->website;
    }

    public function setWebsite(string $website): void
    {
        $this->website = $website;
    }

    public function getCenterId(): string
    {
        return $this->centerId;
    }

    public function setCenterId(string $centerId): void
    {
        $this->centerId = $centerId;
    }

    public function getLogo(): string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): void
    {
        $this->logo = $logo;
    }

    public function getCertifier(): int
    {
        return $this->certifier;
    }

    public function setCertifier(int $certifier): void
    {
        $this->certifier = $certifier;
    }
}