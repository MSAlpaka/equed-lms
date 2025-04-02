<?php

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Instructor extends AbstractEntity
{
    protected int $feUser = 0;
    protected string $name = '';
    protected string $email = '';
    protected bool $isAvailable = true;
    protected string $regionPostalCodes = '';

    protected ?Center $center = null;

    public function getFeUser(): int
    {
        return $this->feUser;
    }

    public function setFeUser(int $feUser): void
    {
        $this->feUser = $feUser;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function isAvailable(): bool
    {
        return $this->isAvailable;
    }

    public function setIsAvailable(bool $isAvailable): void
    {
        $this->isAvailable = $isAvailable;
    }

    public function getRegionPostalCodes(): string
    {
        return $this->regionPostalCodes;
    }

    public function setRegionPostalCodes(string $codes): void
    {
        $this->regionPostalCodes = $codes;
    }

    public function getCenter(): ?Center
    {
        return $this->center;
    }

    public function setCenter(?Center $center): void
    {
        $this->center = $center;
    }
}