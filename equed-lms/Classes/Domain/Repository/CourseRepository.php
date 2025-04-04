<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Repository;

use Equed\EquedLms\Domain\Model\Course;
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
        return $this->createQuery()
            ->matching(
                $this->createQuery()->logicalAnd([
                    $this->createQuery()->equals('active', true),
                    $this->createQuery()->equals('visible', true),
                ])
            )
            ->execute()
            ->toArray();
    }

    /**
     * Find all courses for a specific center
     *
     * @param int $centerId
     * @return Course[]
     */
    public function findByCenter(int $centerId): array
    {
        return $this->createQuery()
            ->matching(
                $this->createQuery()->equals('center', $centerId)
            )
            ->execute()
            ->toArray();
    }

    /**
     * Find one course by course code
     *
     * @param string $courseCode
     * @return Course|null
     */
    public function findOneByCourseCode(string $courseCode): ?Course
    {
        return $this->createQuery()
            ->matching(
                $this->createQuery()->equals('courseCode', $courseCode)
            )
            ->setLimit(1)
            ->execute()
            ->getFirst();
    }
}