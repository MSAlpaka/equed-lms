<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Repository;

use Equed\EquedLms\Domain\Model\QuizAnswer;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for QuizAnswer entities
 */
class QuizAnswerRepository extends Repository
{
    /**
     * Find the correct answer for a given question
     *
     * @param int $questionId
     * @return QuizAnswer|null
     */
    public function findCorrectByQuestion(int $questionId): ?QuizAnswer
    {
        $query = $this->createQuery();
        return $query->matching(
            $query->logicalAnd([
                $query->equals('question', $questionId),
                $query->equals('correct', true),
            ])
        )->execute()->getFirst();
    }
}