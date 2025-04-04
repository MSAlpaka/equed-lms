<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Repository;

use Equed\EquedLms\Domain\Model\UserSubmission;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for UserSubmission entities
 */
class UserSubmissionRepository extends Repository
{
    /**
     * Find all submissions for a given user and course
     *
     * @param int $userId
     * @param int $courseId
     * @return UserSubmission[]
     */
    public function findByUserAndCourse(int $userId, int $courseId): array
    {
        return $this->createQuery()
            ->matching(
                $this->createQuery()->logicalAnd([
                    $this->createQuery()->equals('user', $userId),
                    $this->createQuery()->equals('course', $courseId),
                ])
            )
            ->execute()
            ->toArray();
    }

    /**
     * Find all submissions with status 'submitted'
     *
     * @return UserSubmission[]
     */
    public function findPending(): array
    {
        return $this->createQuery()
            ->matching(
                $this->createQuery()->equals('status', 'submitted')
            )
            ->execute()
            ->toArray();
    }
}