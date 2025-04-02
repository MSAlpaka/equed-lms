<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class CourseProgressViewHelper extends AbstractViewHelper
{
    /**
     * @param int $userId
     * @param int $courseId
     * @return string
     */
    public function render(int $userId, int $courseId): string
    {
        // Fetch user progress in the course
        $progress = $this->getCourseProgress($userId, $courseId);
        return $progress . '% Completed';
    }

    /**
     * Calculate the course progress for a user
     *
     * @param int $userId
     * @param int $courseId
     * @return int
     */
    protected function getCourseProgress(int $userId, int $courseId): int
    {
        $repository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\Equed\EquedLms\Domain\Repository\UserCourseRecordRepository::class);
        $records = $repository->findByUserAndCourse($userId, $courseId);
        $completedLessons = count(array_filter($records, fn($record) => $record->getCompleted() === true));
        $totalLessons = count($records);
        return ($totalLessons > 0) ? ($completedLessons / $totalLessons) * 100 : 0;
    }
}