<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Equed\EquedLms\Domain\Repository\CourseRepository;

class CourseDurationViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('courseId', 'int', 'Course ID', true);
    }

    public function render(): string
    {
        $courseId = (int)$this->arguments['courseId'];
        $course = $this->getCourseById($courseId);

        if (!$course) {
            return LocalizationUtility::translate('course.duration_unavailable', 'equed_lms') ?? 'Duration not available';
        }

        return $this->formatDuration($course->getDuration());
    }

    protected function formatDuration(int $duration): string
    {
        $hours = floor($duration / 60);
        $minutes = $duration % 60;

        $hoursLabel = LocalizationUtility::translate('course.hours', 'equed_lms') ?? 'hours';
        $minutesLabel = LocalizationUtility::translate('course.minutes', 'equed_lms') ?? 'minutes';

        return sprintf('%d %s %d %s', $hours, $hoursLabel, $minutes, $minutesLabel);
    }

    protected function getCourseById(int $courseId)
    {
        /** @var CourseRepository $courseRepository */
        $courseRepository = GeneralUtility::makeInstance(CourseRepository::class);
        return $courseRepository->findByIdentifier($courseId);
    }
}