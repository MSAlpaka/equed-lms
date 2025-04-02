<?php

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;

/**
 * Represents a badge (achievement) within the LMS.
 */
class Badge extends AbstractEntity
{
    protected string $name = '';

    protected string $description = '';

    protected string $identifier = ''; // e.g. "hoofcare-specialist"

    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference|null
     */
    protected ?FileReference $icon = null;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function getIcon(): ?FileReference
    {
        return $this->icon;
    }

    public function setIcon(?FileReference $icon): void
    {
        $this->icon = $icon;
    }
}