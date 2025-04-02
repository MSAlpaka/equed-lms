<?php

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Lesson extends AbstractEntity
{
    protected string $title = '';
    protected string $slug = '';
    protected int $position = 0;

    /**
     * @var \Equed\EquedLms\Domain\Model\Course
     */
    protected $course;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Equed\EquedLms\Domain\Model\ContentPage>
     */
    protected $contentpages;

    public function __construct()
    {
        $this->contentpages = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    public function getTitle(): string { return $this->title; }
    public function setTitle(string $title): void { $this->title = $title; }

    public function getSlug(): string { return $this->slug; }
    public function setSlug(string $slug): void { $this->slug = $slug; }

    public function getPosition(): int { return $this->position; }
    public function setPosition(int $position): void { $this->position = $position; }

    public function getCourse() { return $this->course; }
    public function setCourse($course): void { $this->course = $course; }

    public function getContentpages() { return $this->contentpages; }
    public function setContentpages($contentpages): void { $this->contentpages = $contentpages; }
}