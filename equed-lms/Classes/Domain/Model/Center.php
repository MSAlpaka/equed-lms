<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;

/**
 * Represents an official EquEd Training Center.
 *
 * Centers are assigned unique IDs and linked to instructors, courses and certifiers.
 * This model supports geo-location, rating, and status for QMS and public visibility.
 */
class Center extends AbstractEntity
{
    protected string $name = '';

    protected string $street = '';

    protected string $zip = '';

    protected string $city = '';

    protected string $country = '';

    protected string $region = '';

    protected string $website = '';

    protected string $centerId = '';

    protected ?FileReference $logo = null;

    protected ?FrontendUser $certifier = null;

    /**
     * Current status of the training center.
     * Options: active, suspended, under_review
     */
    protected string $status = 'active';

    /**
     * Latitude coordinate (e.g. 48.13743)
     */
    protected float $latitude = 0.0;

    /**
     * Longitude coordinate (e.g. 11.57549)
     */
    protected float $longitude = 0.0;

    /**
     * Optional average rating (from feedback)
     */
    protected float $ratingAverage = 0.0;

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

    public function getRegion(): string
    {
        return $this->region;
    }

    public function setRegion(string $region): void
    {
        $this->region = $region;
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

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): void
    {
        $this->latitude = $latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): void
    {
        $this->longitude = $longitude;
    }

    public function getRatingAverage(): float
    {
        return $this->ratingAverage;
    }

    public function setRatingAverage(float $ratingAverage): void
    {
        $this->ratingAverage = $ratingAverage;
    }
}