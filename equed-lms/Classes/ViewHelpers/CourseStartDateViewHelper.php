<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Equed\EquedLms\Domain\Repository\CourseRepository;

class CourseStartDateViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('courseId', 'int', 'Course ID', true);
        $this->registerArgument('format', 'string', 'Date format', false, 'F j, Y');
    }

    public function render(): string
    {
        $courseId = (int)$this->arguments['courseId'];
        $format = $this->arguments['format'];

        $course = $this->getCourseById($courseId);
        $date = $course?->getStartDate();

        return $date instanceof \DateTime
            ? $date->format($format)
            : LocalizationUtility::translate('course.start.unknown', 'equed_lms') ?? 'Unknown Start Date';
    }

    protected function getCourseById(int $courseId)
    {
        /** @var CourseRepository $courseRepository */
        $courseRepository = GeneralUtility::makeInstance(CourseRepository::class);
        return $courseRepository->findByIdentifier($courseId);
    }
}