<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Repository;

use Equed\EquedLms\Domain\Model\ExamAttempt;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for ExamAttempt entities
 */
class ExamAttemptRepository extends Repository
{
    /**
     * Find all exam attempts by user
     *
     * @param int $userId
     * @return ExamAttempt[]
     */
    public function findByUser(int $userId): array
    {
        return $this->createQuery()
            ->matching(
                $this->createQuery()->equals('user', $userId)
            )
            ->execute()
            ->toArray();
    }

    /**
     * Find exam attempts by user and question
     *
     * @param int $userId
     * @param int $questionId
     * @return ExamAttempt[]
     */
    public function findByUserAndQuestion(int $userId, int $questionId): array
    {
        return $this->createQuery()
            ->matching(
                $this->createQuery()->logicalAnd([
                    $this->createQuery()->equals('user', $userId),
                    $this->createQuery()->equals('quizQuestion', $questionId),
                ])
            )
            ->execute()
            ->toArray();
    }

    /**
     * Find all correct exam attempts by user
     *
     * @param int $userId
     * @return ExamAttempt[]
     */
    public function findCorrectByUser(int $userId): array
    {
        return $this->createQuery()
            ->matching(
                $this->createQuery()->logicalAnd([
                    $this->createQuery()->equals('user', $userId),
                    $this->createQuery()->equals('correct', true),
                ])
            )
            ->execute()
            ->toArray();
    }
}