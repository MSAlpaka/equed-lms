<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class CourseDurationViewHelper extends AbstractViewHelper
{
    /**
     * @param int $courseId
     * @return string
     */
    public function render(int $courseId): string
    {
        // Fetch course duration
        $course = $this->getCourseById($courseId);
        return $course ? $this->formatDuration($course->getDuration()) : 'Duration not available';
    }

    /**
     * Format the course duration to a human-readable format
     *
     * @param int $duration
     * @return string
     */
    protected function formatDuration(int $duration): string
    {
        $hours = floor($duration / 60);
        $minutes = $duration % 60;
        return "$hours hours $minutes minutes";
    }

    /**
     * Fetch course data by ID
     *
     * @param int $courseId
     * @return \Equed\EquedLms\Domain\Model\Course|null
     */
    protected function getCourseById(int $courseId)
    {
        $courseRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\Equed\EquedLms\Domain\Repository\CourseRepository::class);
        return $courseRepository->findByIdentifier($courseId);
    }
}