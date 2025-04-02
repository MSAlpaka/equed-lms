<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class CourseInstructorViewHelper extends AbstractViewHelper
{
    /**
     * @param int $courseId
     * @return string
     */
    public function render(int $courseId): string
    {
        // Fetch course instructor
        $course = $this->getCourseById($courseId);
        $instructor = $course ? $course->getInstructor() : null;
        return $instructor ? $instructor->getName() : 'No Instructor Assigned';
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