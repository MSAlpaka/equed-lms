<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Repository;

use Equed\EquedLms\Domain\Model\UserLessonProgress;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for UserLessonProgress entities
 */
class UserLessonProgressRepository extends Repository
{
    /**
     * Find all completed lessons by user
     *
     * @param int $userId
     * @return UserLessonProgress[]
     */
    public function findCompletedByUser(int $userId): array
    {
        $query = $this->createQuery();
        return $query
            ->matching($query->logicalAnd([
                $query->equals('user', $userId),
                $query->equals('completed', true),
            ]))
            ->execute()
            ->toArray();
    }

    /**
     * Find progress of a specific lesson for a user
     *
     * @param int $userId
     * @param int $lessonId
     * @return UserLessonProgress|null
     */
    public function findByUserAndLesson(int $userId, int $lessonId): ?UserLessonProgress
    {
        $query = $this->createQuery();
        return $query
            ->matching($query->logicalAnd([
                $query->equals('user', $userId),
                $query->equals('lesson', $lessonId),
            ]))
            ->execute()
            ->getFirst();
    }
}