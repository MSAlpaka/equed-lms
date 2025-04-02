<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class CourseStatusViewHelper extends AbstractViewHelper
{
    /**
     * @param int $courseId
     * @return string
     */
    public function render(int $courseId): string
    {
        // Fetch the course status
        $course = $this->getCourseById($courseId);
        return $course ? $this->getStatusText($course->getStatus()) : 'Status Unknown';
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

    /**
     * Get readable status text based on status code
     *
     * @param int $status
     * @return string
     */
    protected function getStatusText(int $status): string
    {
        switch ($status) {
            case 1:
                return 'Active';
            case 0:
                return 'Inactive';
            default:
                return 'Unknown Status';
        }
    }
}