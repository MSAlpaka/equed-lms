<?php

namespace Equed\EquedLms\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;

class UserLessonProgressRepository extends Repository
{
    /**
     * Find all completed lessons by user
     */
    public function findCompletedByUser(int $userId): array
    {
        $query = $this->createQuery();
        return $query
            ->matching(
                $query->logicalAnd([
                    $query->equals('user', $userId),
                    $query->equals('completed', true),
                ])
            )
            ->execute()
            ->toArray();
    }

    /**
     * Find specific lesson progress for user
     */
    public function findByUserAndLesson(int $userId, int $lessonId): ?object
    {
        $query = $this->createQuery();
        $result = $query
            ->matching(
                $query->logicalAnd([
                    $query->equals('user', $userId),
                    $query->equals('lesson', $lessonId),
                ])
            )
            ->execute();

        return $result->getFirst();
    }
}