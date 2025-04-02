<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class UserCompletionProgressViewHelper extends AbstractViewHelper
{
    /**
     * @param int $userId
     * @param int $courseId
     * @return string
     */
    public function render(int $userId, int $courseId): string
    {
        // Calculate completion percentage based on the user and course
        $completion = $this->getUserCourseCompletion($userId, $courseId);
        return "$completion% Completed";
    }

    /**
     * Get user course completion percentage
     *
     * @param int $userId
     * @param int $courseId
     * @return int
     */
    protected function getUserCourseCompletion(int $userId, int $courseId): int
    {
        // Logic to calculate the completion percentage
        // (can involve querying the UserCourseRecordRepository)
        $userCourseRecordRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\Equed\EquedLms\Domain\Repository\UserCourseRecordRepository::class);
        $records = $userCourseRecordRepository->findByUserAndCourse($userId, $courseId);
        $completedLessons = count(array_filter($records, function($record) {
            return $record->getCompleted() === true;
        }));
        $totalLessons = count($records);
        return ($totalLessons > 0) ? ($completedLessons / $totalLessons) * 100 : 0;
    }
}