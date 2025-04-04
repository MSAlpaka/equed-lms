<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Repository;

use Equed\EquedLms\Domain\Model\Lesson;
use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;

/**
 * Repository for Lesson entities
 */
class LessonRepository extends Repository
{
    /**
     * Find all lessons for a specific course, ordered by sortOrder
     *
     * @param int $courseId
     * @return Lesson[]
     */
    public function findByCourse(int $courseId): array
    {
        return $this->createQuery()
            ->matching(
                $this->createQuery()->equals('course', $courseId)
            )
            ->setOrderings([
                'sortOrder' => QueryInterface::ORDER_ASCENDING
            ])
            ->execute()
            ->toArray();
    }

    /**
     * Find required lessons of a course
     *
     * @param int $courseId
     * @return Lesson[]
     */
    public function findRequiredLessonsByCourse(int $courseId): array
    {
        return $this->createQuery()
            ->matching(
                $this->createQuery()->logicalAnd([
                    $this->createQuery()->equals('course', $courseId),
                    $this->createQuery()->equals('required', true),
                ])
            )
            ->execute()
            ->toArray();
    }
}