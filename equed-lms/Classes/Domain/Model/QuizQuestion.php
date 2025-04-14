<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;

class QuizQuestion extends AbstractEntity
{
    protected int $pid = 0;

    protected string $questionText = '';
    protected string $explanation = '';
    protected string $type = 'single'; // single, multiple, text
    protected int $score = 1;
    protected int $position = 0;
    protected string $difficulty = 'medium';
    protected bool $required = true;
    protected bool $hidden = false;

    #[Lazy]
    protected ?FileReference $image = null;

    #[Lazy]
    protected ?Lesson $lesson = null;

    /** @var ObjectStorage<QuizAnswer> */
    #[Lazy]
    protected ObjectStorage $answers;

    public function __construct()
    {
        $this->answers = new ObjectStorage();
    }

    public function getQuestionText(): string { return $this->questionText; }
    public function setQuestionText(string $text): void { $this->questionText = $text; }

    public function getExplanation(): string { return $this->explanation; }
    public function setExplanation(string $explanation): void { $this->explanation = $explanation; }

    public function getType(): string { return $this->type; }
    public function setType(string $type): void { $this->type = $type; }

    public function getScore(): int { return $this->score; }
    public function setScore(int $score): void { $this->score = $score; }

    public function getPosition(): int { return $this->position; }
    public function setPosition(int $pos): void { $this->position = $pos; }

    public function getDifficulty(): string { return $this->difficulty; }
    public function setDifficulty(string $difficulty): void { $this->difficulty = $difficulty; }

    public function isRequired(): bool { return $this->required; }
    public function setRequired(bool $required): void { $this->required = $required; }

    public function isHidden(): bool { return $this->hidden; }
    public function setHidden(bool $hidden): void { $this->hidden = $hidden; }

    public function getImage(): ?FileReference { return $this->image; }
    public function setImage(?FileReference $image): void { $this->image = $image; }

    public function getLesson(): ?Lesson { return $this->lesson; }
    public function setLesson(?Lesson $lesson): void { $this->lesson = $lesson; }

    public function getAnswers(): ObjectStorage { return $this->answers; }
    public function addAnswer(QuizAnswer $answer): void { $this->answers->attach($answer); }
}