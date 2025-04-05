<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Equed\EquedLms\Domain\Repository\CourseRepository;

class CourseStatusViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('courseId', 'int', 'Course ID', true);
    }

    public function render(): string
    {
        $courseId = (int)$this->arguments['courseId'];
        $course = $this->getCourseById($courseId);

        $status = $course?->getStatus();
        return $this->getStatusText((int)$status);
    }

    protected function getCourseById(int $courseId)
    {
        /** @var CourseRepository $courseRepository */
        $courseRepository = GeneralUtility::makeInstance(CourseRepository::class);
        return $courseRepository->findByIdentifier($courseId);
    }

    protected function getStatusText(int $status): string
    {
        return match ($status) {
            1 => LocalizationUtility::translate('course.status.active', 'equed_lms') ?? 'Active',
            0 => LocalizationUtility::translate('course.status.inactive', 'equed_lms') ?? 'Inactive',
            default => LocalizationUtility::translate('course.status.unknown', 'equed_lms') ?? 'Unknown Status',
        };
    }
}