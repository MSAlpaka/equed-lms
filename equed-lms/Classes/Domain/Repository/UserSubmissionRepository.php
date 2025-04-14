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
     * Find all submissions that are pending (status = "submitted")
     *
     * @return UserSubmission[]
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

    /**
     * Optional: Find by UserCourseRecord ID (alternative zu findByUserAndCourse)
     *
     * @param int $userCourseRecordId
     * @return UserSubmission[]
     */
    public function findByUserCourseRecord(int $userCourseRecordId): array
    {
        $query = $this->createQuery();
        return $query
            ->matching($query->equals('userCourseRecord', $userCourseRecordId))
            ->execute()
            ->toArray();
    }

    /**
     * Optional: Find all submissions of a specific user
     *
     * @param int $userId
     * @return UserSubmission[]
     */
    public function findByUser(int $userId): array
    {
        $query = $this->createQuery();
        return $query
            ->matching($query->equals('user', $userId))
            ->execute()
            ->toArray();
    }
}