<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Equed\EquedLms\Domain\Repository\CourseRepository;

class CourseTypeViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('courseId', 'int', 'Course ID', true);
    }

    public function render(): string
    {
        $courseId = (int)$this->arguments['courseId'];
        $course = $this->getCourseById($courseId);

        $type = $course?->getType();
        return $this->getCourseTypeLabel((int)$type);
    }

    protected function getCourseById(int $courseId)
    {
        /** @var CourseRepository $repo */
        $repo = GeneralUtility::makeInstance(CourseRepository::class);
        return $repo->findByIdentifier($courseId);
    }

    protected function getCourseTypeLabel(int $type): string
    {
        return match ($type) {
            1 => LocalizationUtility::translate('course.type.online', 'equed_lms') ?? 'Online',
            2 => LocalizationUtility::translate('course.type.inperson', 'equed_lms') ?? 'In-person',
            default => LocalizationUtility::translate('course.type.hybrid', 'equed_lms') ?? 'Hybrid',
        };
    }
}