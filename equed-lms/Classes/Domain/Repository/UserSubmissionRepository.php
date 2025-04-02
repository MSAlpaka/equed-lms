<?php

namespace Equed\EquedLms\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;

class UserSubmissionRepository extends Repository
{
    /**
     * Find all submissions for a given user and course
     */
    public function findByUserAndCourse(int $userId, int $courseId): array
    {
        $query = $this->createQuery();
        return $query
            ->matching(
                $query->logicalAnd([
                    $query->equals('user', $userId),
                    $query->equals('course', $courseId),
                ])
            )
            ->execute()
            ->toArray();
    }

    /**
     * Find all pending (submitted) submissions
     */
    public function findPending(): array
    {
        $query = $this->createQuery();
        return $query
            ->matching(
                $query->equals('status', 'submitted')
            )
            ->execute()
            ->toArray();
    }
}