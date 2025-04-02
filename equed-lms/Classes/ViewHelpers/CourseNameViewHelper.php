<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class CourseNameViewHelper extends AbstractViewHelper
{
    /**
     * @param int $courseId
     * @return string
     */
    public function render(int $courseId): string
    {
        // Fetch course name from the database
        $course = $this->getCourseById($courseId);
        return $course ? $course->getName() : 'Unknown Course';
    }

    /**
     * Fetch course by ID
     *
     * @param int $courseId
     * @return \Equed\EquedLms\Domain\Model\Course|null
     */
    protected function getCourseById(int $courseId)
    {
        // Call to repository or service to get course data
        $courseRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\Equed\EquedLms\Domain\Repository\CourseRepository::class);
        return $courseRepository->findByIdentifier($courseId);
    }
}