<?php

namespace Equed\EquedLms\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;

class CourseRepository extends Repository
{
    /**
     * Find all active and visible courses
     */
    public function findAllVisible(): array
    {
        $query = $this->createQuery();
        return $query
            ->matching(
                $query->logicalAnd([
                    $query->equals('active', true),
                    $query->equals('visible', true),
                ])
            )
            ->execute()
            ->toArray();
    }

    /**
     * Find all courses for a specific center
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
     * Find one course by code
     */
    public function findOneByCourseCode(string $courseCode): ?object
    {
        $query = $this->createQuery();
        $result = $query
            ->matching(
                $query->equals('courseCode', $courseCode)
            )
            ->setLimit(1)
            ->execute();

        return $result->getFirst();
    }
}