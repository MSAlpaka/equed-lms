<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Equed\EquedLms\Domain\Repository\UserCourseRecordRepository;

class UserCompletionProgressViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('userId', 'int', 'User ID', true);
        $this->registerArgument('courseId', 'int', 'Course ID', true);
    }

    public function render(): string
    {
        $userId = (int)$this->arguments['userId'];
        $courseId = (int)$this->arguments['courseId'];

        $completion = $this->getUserCourseCompletion($userId, $courseId);
        $label = LocalizationUtility::translate('course.completed', 'equed_lms') ?? 'Completed';

        return sprintf('%d%% %s', $completion, $label);
    }

    protected function getUserCourseCompletion(int $userId, int $courseId): int
    {
        /** @var UserCourseRecordRepository $repository */
        $repository = GeneralUtility::makeInstance(UserCourseRecordRepository::class);
        $records = $repository->findByUserAndCourse($userId, $courseId);

        $completedLessons = count(array_filter($records, fn($record) => $record->getCompleted() === true));
        $totalLessons = count($records);

        return ($totalLessons > 0) ? (int)(($completedLessons / $totalLessons) * 100) : 0;
    }
}