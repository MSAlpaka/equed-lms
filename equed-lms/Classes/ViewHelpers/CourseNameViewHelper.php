<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Equed\EquedLms\Domain\Repository\CourseRepository;

class CourseNameViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('courseId', 'int', 'Course ID', true);
    }

    public function render(): string
    {
        $courseId = (int)$this->arguments['courseId'];
        $course = $this->getCourseById($courseId);

        return $course?->getName()
            ?? LocalizationUtility::translate('course.unknown', 'equed_lms')
            ?? 'Unknown Course';
    }

    protected function getCourseById(int $courseId)
    {
        /** @var CourseRepository $courseRepository */
        $courseRepository = GeneralUtility::makeInstance(CourseRepository::class);
        return $courseRepository->findByIdentifier($courseId);
    }
}