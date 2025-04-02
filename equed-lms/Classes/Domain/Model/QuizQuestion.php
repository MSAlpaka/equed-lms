<?php

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Equed\EquedLms\Domain\Model\Lesson;
use Equed\EquedLms\Domain\Model\Course;
use Equed\EquedLms\Domain\Model\QuizAnswer;

/**
 * Represents a quiz question that belongs to a lesson or course.
 */
class QuizQuestion extends AbstractEntity
{
    protected string $questionText = '';

    /**
     * Possible values: 'single', 'multiple', 'truefalse'
     */
    protected string $type = 'single';

    protected bool $required = true;

    protected int $points = 1;

    /**
     * @var \Equed\EquedLms\Domain\Model\Lesson|null
     */
    protected ?Lesson $lesson = null;

    /**
     * @var \Equed\EquedLms\Domain\Model\Course|null
     */
    protected ?Course $course = null;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Equed\EquedLms\Domain\Model\QuizAnswer>
     */
    protected ObjectStorage $answers;

    public function __construct()
    {
        $this->answers = new ObjectStorage();
    }

    public function getQuestionText(): string
    {
        return $this->questionText;
    }

    public function setQuestionText(string $questionText): void
    {
        $this->questionText = $questionText;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function setRequired(bool $required): void
    {
        $this->required = $required;
    }

    public function getPoints(): int
    {
        return $this->points;
    }

    public function setPoints(int $points): void
    {
        $this->points = $points;
    }

    public function getLesson(): ?Lesson
    {
        return $this->lesson;
    }

    public function setLesson(?Lesson $lesson): void
    {
        $this->lesson = $lesson;
    }

    public function getCourse(): ?Course
    {
        return $this->course;
    }

    public function setCourse(?Course $course): void
    {
        $this->course = $course;
    }

    public function getAnswers(): ObjectStorage
    {
        return $this->answers;
    }

    public function addAnswer(QuizAnswer $answer): void
    {
        $this->answers->attach($answer);
    }

    public function removeAnswer(QuizAnswer $answer): void
    {
        $this->answers->detach($answer);
    }
}