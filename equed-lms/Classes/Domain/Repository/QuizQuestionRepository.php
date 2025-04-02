<?php

namespace Equed\EquedLms\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;

class QuizQuestionRepository extends Repository
{
    /**
     * Find all questions for a specific lesson
     */
    public function findByLesson(int $lessonId): array
    {
        $query = $this->createQuery();
        return $query
            ->matching(
                $query->equals('lesson', $lessonId)
            )
            ->execute()
            ->toArray();
    }

    /**
     * Find all required questions for a course (regardless of lesson)
     */
    public function findRequiredByCourse(int $courseId): array
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