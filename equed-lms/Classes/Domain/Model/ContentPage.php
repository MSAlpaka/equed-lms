<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;

class ContentPage extends AbstractEntity
{
    protected int $pid = 0;

    protected string $title = '';
    protected string $text = '';
    protected int $position = 0;

    #[Lazy]
    protected ?Lesson $lesson = null;

    protected bool $isRequired = true;

    #[Lazy]
    protected ?QuizQuestion $quizQuestion = null;

    /** @var ObjectStorage<FileReference> */
    protected ObjectStorage $media;

    /** @var ObjectStorage<FileReference> */
    protected ObjectStorage $downloads;

    public function __construct()
    {
        $this->media = new ObjectStorage();
        $this->downloads = new ObjectStorage();
    }

    public function getTitle(): string { return $this->title; }
    public function setTitle(string $title): void { $this->title = $title; }

    public function getText(): string { return $this->text; }
    public function setText(string $text): void { $this->text = $text; }

    public function getPosition(): int { return $this->position; }
    public function setPosition(int $position): void { $this->position = $position; }

    public function getLesson(): ?Lesson { return $this->lesson; }
    public function setLesson(?Lesson $lesson): void { $this->lesson = $lesson; }

    public function isRequired(): bool { return $this->isRequired; }
    public function setIsRequired(bool $required): void { $this->isRequired = $required; }

    public function getQuizQuestion(): ?QuizQuestion { return $this->quizQuestion; }
    public function setQuizQuestion(?QuizQuestion $quizQuestion): void { $this->quizQuestion = $quizQuestion; }

    public function getMedia(): ObjectStorage { return $this->media; }
    public function addMedia(FileReference $media): void { $this->media->attach($media); }

    public function getDownloads(): ObjectStorage { return $this->downloads; }
    public function addDownload(FileReference $file): void { $this->downloads->attach($file); }
}