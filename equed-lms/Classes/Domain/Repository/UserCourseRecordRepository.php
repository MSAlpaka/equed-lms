<?php

namespace Equed\EquedLms\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;

class UserCourseRecordRepository extends Repository
{
    /**
     * Find all course records for a specific user
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
     * Find validated completions for a specific course
     */
    public function findValidatedByCourse(int $courseId): array
    {
        $query = $this->createQuery();
        return $query
            ->matching(
                $query->logicalAnd(
                    $query->equals('course', $courseId),
                    $query->equals('validated', true)
                )
            )
            ->execute()
            ->toArray();
    }
}