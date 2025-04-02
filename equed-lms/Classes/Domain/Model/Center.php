<?php

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;

/**
 * Represents a training center within the EquEd LMS.
 */
class Center extends AbstractEntity
{
    protected string $name = '';

    protected string $street = '';

    protected string $zip = '';

    protected string $city = '';

    protected string $country = '';

    protected string $phone = '';

    protected string $website = '';

    protected string $centerId = ''; // für eindeutige Zuordnung

    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference|null
     */
    protected ?FileReference $logo = null;

    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser|null
     */
    protected ?FrontendUser $certifier = null;

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

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
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

    public function getLogo(): ?FileReference
    {
        return $this->logo;
    }

    public function setLogo(?FileReference $logo): void
    {
        $this->logo = $logo;
    }

    public function getCertifier(): ?FrontendUser
    {
        return $this->certifier;
    }

    public function setCertifier(?FrontendUser $certifier): void
    {
        $this->certifier = $certifier;
    }
}