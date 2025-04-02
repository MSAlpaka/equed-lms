<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class CourseCompletionProgressViewHelper extends AbstractViewHelper
{
    /**
     * @param int $userId
     * @param int $courseId
     * @return string
     */
    public function render(int $userId, int $courseId): string
    {
        // Fetch user progress in the course
        $progress = $this->getCourseCompletionProgress($userId, $courseId);
        return "$progress% Completed";
    }

    /**
     * Calculate course completion progress
     *
     * @param int $userId
     * @param int $courseId
     * @return int
     */
    protected function getCourseCompletionProgress(int $userId, int $courseId): int
    {
        $repository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\Equed\EquedLms\Domain\Repository\UserCourseRecordRepository::class);
        $records = $repository->findByUserAndCourse($userId, $courseId);
        $completedLessons = count(array_filter($records, fn($record) => $record->getCompleted() === true));
        $totalLessons = count($records);
        return ($totalLessons > 0) ? ($completedLessons / $totalLessons) * 100 : 0;
    }
}