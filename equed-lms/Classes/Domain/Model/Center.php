<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;

/**
 * Offizieller Ausbildungsort (EquEd Training Center).
 *
 * Wird einem Certifier zugewiesen und kann Kurse, Bewertungen und Zertifizierungen durchführen.
 * Unterstützt Geodaten für Zuordnungen und Status-Management für QMS-Prozesse.
 */
class Center extends AbstractEntity
{
    protected int $pid = 0;

    protected string $name = '';

    protected string $street = '';

    protected string $zip = '';

    protected string $city = '';

    protected string $country = '';

    protected string $region = '';

    protected string $website = '';

    protected string $centerId = '';

    #[Lazy]
    protected ?FileReference $logo = null;

    #[Lazy]
    protected ?FrontendUser $certifier = null;

    /**
     * Status des Centers (z. B. active, suspended, under_review)
     */
    protected string $status = 'active';

    /**
     * Breitengrad für Geodaten (z. B. 48.13743)
     */
    protected float $latitude = 0.0;

    /**
     * Längengrad für Geodaten (z. B. 11.57549)
     */
    protected float $longitude = 0.0;

    /**
     * Durchschnittsbewertung (aus Feedbacks berechnet)
     */
    protected float $ratingAverage = 0.0;

    public function getPid(): int
    {
        return $this->pid;
    }

    public function setPid(int $pid): void
    {
        $this->pid = $pid;
    }

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