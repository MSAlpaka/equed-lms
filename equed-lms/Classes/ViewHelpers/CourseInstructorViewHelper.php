<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Equed\EquedLms\Domain\Repository\CourseRepository;

class CourseInstructorViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('courseId', 'int', 'Course ID', true);
    }

    public function render(): string
    {
        $courseId = (int)$this->arguments['courseId'];
        $course = $this->getCourseById($courseId);
        $instructor = $course ? $course->getInstructor() : null;

        return $instructor?->getName()
            ?? LocalizationUtility::translate('course.instructor.none', 'equed_lms')
            ?? 'No Instructor Assigned';
    }

    protected function getCourseById(int $courseId)
    {
        /** @var CourseRepository $courseRepository */
        $courseRepository = GeneralUtility::makeInstance(CourseRepository::class);
        return $courseRepository->findByIdentifier($courseId);
    }
}