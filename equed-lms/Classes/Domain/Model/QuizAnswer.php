<?php
namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class QuizAnswer extends AbstractEntity
{
    /**
     * @var string
     */
    protected string $answerText = '';

    /**
     * @var bool
     */
    protected bool $isCorrect = false;

    public function getAnswerText(): string
    {
        return $this->answerText;
    }

    public function setAnswerText(string $answerText): void
    {
        $this->answerText = $answerText;
    }

    public function isCorrect(): bool
    {
        return $this->isCorrect;
    }

    public function setIsCorrect(bool $isCorrect): void
    {
        $this->isCorrect = $isCorrect;
    }
}