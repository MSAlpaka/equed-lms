<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Course extends AbstractEntity
{
    protected string $title = '';
    protected string $description = '';
    protected string $category = '';
    protected bool $isActive = true;

    // 🔄 Abschlussziel für Zertifizierung
    protected string $finishGoal = '';

    // 🆕 Voraussetzungen für den Kurs (z. B. Abschlussziele anderer Kurse)
    protected array $prerequisites = [];

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

    public function getFinishGoal(): string
    {
        return $this->finishGoal;
    }

    public function setFinishGoal(string $finishGoal): void
    {
        $this->finishGoal = $finishGoal;
    }

    public function getPrerequisites(): array
    {
        return $this->prerequisites;
    }

    public function setPrerequisites(array $prerequisites): void
    {
        $this->prerequisites = $prerequisites;
    }
}