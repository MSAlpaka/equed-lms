<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Repository;

use Equed\EquedLms\Domain\Model\Course;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for Course entities
 */
class CourseRepository extends Repository
{
    /**
     * Find all active and visible courses
     *
     * @return Course[]
     */
    public function findAllVisible(): array
    {
        $query = $this->createQuery();
        return $query->matching(
            $query->logicalAnd([
                $query->equals('active', true),
                $query->equals('visible', true),
            ])
        )->execute()->toArray();
    }

    /**
     * Find all courses for a specific center
     *
     * @param int $centerId
     * @return Course[]
     */
    public function findByCenter(int $centerId): array
    {
        $query = $this->createQuery();
        return $query
            ->matching(
                $query->equals('center', $centerId)
            )
            ->execute()
            ->toArray();
    }

    /**
     * Find all courses where the given user is an instructor
     *
     * @param FrontendUser $user
     * @return Course[]
     */
    public function findByInstructor(FrontendUser $user): array
    {
        $query = $this->createQuery();
        return $query
            ->matching(
                $query->contains('instructors', $user)
            )
            ->execute()
            ->toArray();
    }
}