<?php

namespace Equed\EquedLms\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;

class ExamAttemptRepository extends Repository
{
    /**
     * Find all attempts by a user
     */
    public function findByUser(int $userId): array
    {
        $query = $this->createQuery();

        return $query
            ->matching(
                $query->equals('user', $userId)
            )
            ->execute()
            ->toArray();
    }

    /**
     * Find attempts by user and question
     */
    public function findByUserAndQuestion(int $userId, int $questionId): array
    {
        $query = $this->createQuery();

        return $query
            ->matching(
                $query->logicalAnd([
                    $query->equals('user', $userId),
                    $query->equals('quizQuestion', $questionId),
                ])
            )
            ->execute()
            ->toArray();
    }

    /**
     * Find correct attempts by user
     */
    public function findCorrectByUser(int $userId): array
    {
        $query = $this->createQuery();

        return $query
            ->matching(
                $query->logicalAnd([
                    $query->equals('user', $userId),
                    $query->equals('correct', true),
                ])
            )
            ->execute()
            ->toArray();
    }
}