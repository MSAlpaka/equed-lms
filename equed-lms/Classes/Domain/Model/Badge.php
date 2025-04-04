<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Repräsentiert ein Abzeichen, das Teilnehmende durch Aktionen oder Erfolge erhalten.
 */
class Badge extends AbstractEntity
{
    /**
     * Name des Abzeichens (z. B. "100% Theory", "Foal Specialist")
     *
     * @var string
     */
    protected string $name = '';

    /**
     * Beschreibung (z. B. "Für das Abschließen aller Lektionen eines Kurses")
     *
     * @var string
     */
    protected string $description = '';

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
}