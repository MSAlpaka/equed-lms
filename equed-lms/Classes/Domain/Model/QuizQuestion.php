<?php
namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use EquedLms\EquedLms\Domain\Model\QuizAnswer;

class QuizQuestion extends AbstractEntity
{
    protected string $questionText = '';

    /**
     * @var ObjectStorage<QuizAnswer>
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

    /**
     * @return ObjectStorage<QuizAnswer>
     */
    public function getAnswers(): ObjectStorage
    {
        return $this->answers;
    }

    /**
     * @param ObjectStorage<QuizAnswer> $answers
     */
    public function setAnswers(ObjectStorage $answers): void
    {
        $this->answers = $answers;
    }
}