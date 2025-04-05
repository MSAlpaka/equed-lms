<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Equed\EquedLms\Domain\Repository\InstructorRepository;

class InstructorCoursesViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('instructorId', 'int', 'Instructor UID', true);
    }

    public function render(): string
    {
        $instructorId = (int)$this->arguments['instructorId'];
        $courses = $this->getInstructorCourses($instructorId);

        if (empty($courses)) {
            return LocalizationUtility::translate('instructor.no_courses', 'equed_lms') ?? 'No courses assigned';
        }

        $courseNames = array_map(fn($course) => $course->getName(), $courses);
        return implode(', ', $courseNames);
    }

    /**
     * @param int $instructorId
     * @return \Equed\EquedLms\Domain\Model\Course[]
     */
    protected function getInstructorCourses(int $instructorId): array
    {
        /** @var InstructorRepository $repository */
        $repository = GeneralUtility::makeInstance(InstructorRepository::class);
        $instructor = $repository->findByUid($instructorId);
        return $instructor ? $instructor->getCourses() : [];
    }
}