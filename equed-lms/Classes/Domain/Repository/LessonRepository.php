<?php

namespace Equed\EquedLms\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;

class LessonRepository extends Repository
{
    /**
     * Find all lessons for a specific course, ordered by sortOrder
     */
    public function findByCourse(int $courseId): array
    {
        $query = $this->createQuery();
        return $query
            ->matching(
                $query->equals('course', $courseId)
            )
            ->setOrderings([
                'sortOrder' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
            ])
            ->execute()
            ->toArray();
    }

    /**
     * Find required lessons of a course
     */
    public function findRequiredLessonsByCourse(int $courseId): array
    {
        $query = $this->createQuery();
        return $query
            ->matching(
                $query->logicalAnd([
                    $query->equals('course', $courseId),
                    $query->equals('required', true),
                ])
            )
            ->execute()
            ->toArray();
    }
}