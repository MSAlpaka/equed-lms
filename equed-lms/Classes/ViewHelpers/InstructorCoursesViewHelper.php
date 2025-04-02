<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class InstructorCoursesViewHelper extends AbstractViewHelper
{
    /**
     * @param int $instructorId
     * @return string
     */
    public function render(int $instructorId): string
    {
        // Fetch instructor courses
        $courses = $this->getInstructorCourses($instructorId);
        $courseNames = array_map(fn($course) => $course->getName(), $courses);
        return implode(', ', $courseNames);
    }

    /**
     * Get the courses taught by the instructor
     *
     * @param int $instructorId
     * @return \Equed\EquedLms\Domain\Model\Course[]
     */
    protected function getInstructorCourses(int $instructorId): array
    {
        $repository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\Equed\EquedLms\Domain\Repository\InstructorRepository::class);
        $instructor = $repository->findByUid($instructorId);
        return $instructor ? $instructor->getCourses() : [];
    }
}