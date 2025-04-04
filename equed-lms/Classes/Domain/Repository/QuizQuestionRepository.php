<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Repository;

use Equed\EquedLms\Domain\Model\QuizQuestion;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for QuizQuestion entities
 */
class QuizQuestionRepository extends Repository
{
    /**
     * Find all questions for a specific lesson
     *
     * @param int $lessonId
     * @return QuizQuestion[]
     */
    public function findByLesson(int $lessonId): array
    {
        return $this->createQuery()
            ->matching(
                $this->createQuery()->equals('lesson', $lessonId)
            )
            ->execute()
            ->toArray();
    }

    /**
     * Find all required questions for a course (regardless of lesson)
     *
     * @param int $courseId
     * @return QuizQuestion[]
     */
    public function findRequiredByCourse(int $courseId): array
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