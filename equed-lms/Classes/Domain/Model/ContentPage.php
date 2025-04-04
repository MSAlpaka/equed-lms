<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Einzelne Inhaltsseite innerhalb einer Lektion.
 */
class ContentPage extends AbstractEntity
{
    /**
     * Titel der Seite
     *
     * @var string
     */
    protected string $title = '';

    /**
     * Textinhalt (HTML/Text)
     *
     * @var string
     */
    protected string $text = '';

    /**
     * Sortierreihenfolge innerhalb der Lektion
     *
     * @var int
     */
    protected int $position = 0;

    /**
     * Zugehörige Lektion
     *
     * @var Lesson|null
     */
    protected ?Lesson $lesson = null;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    public function getLesson(): ?Lesson
    {
        return $this->lesson;
    }

    public function setLesson(?Lesson $lesson): void
    {
        $this->lesson = $lesson;
    }
}