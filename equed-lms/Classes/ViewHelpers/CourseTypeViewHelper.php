<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class CourseTypeViewHelper extends AbstractViewHelper
{
    /**
     * @param int $courseId
     * @return string
     */
    public function render(int $courseId): string
    {
        // Fetch course type
        $course = $this->getCourseById($courseId);
        return $course ? $this->getCourseType($course->getType()) : 'Unknown Course Type';
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
     * Get the readable course type
     *
     * @param int $type
     * @return string
     */
    protected function getCourseType(int $type): string
    {
        switch ($type) {
            case 1:
                return 'Online';
            case 2:
                return 'In-person';
            default:
                return 'Hybrid';
        }
    }
}