<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Equed\EquedLms\Domain\Repository\LessonRepository;

class LessonStartDateViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('lessonId', 'int', 'Lesson UID', true);
        $this->registerArgument('format', 'string', 'Date format', false, 'F j, Y');
    }

    public function render(): string
    {
        $lessonId = (int)$this->arguments['lessonId'];
        $format = $this->arguments['format'];

        $lesson = $this->getLessonById($lessonId);
        $startDate = $lesson?->getStartDate();

        return $startDate instanceof \DateTimeInterface
            ? $startDate->format($format)
            : LocalizationUtility::translate('lesson.start_date.unknown', 'equed_lms') ?? 'Unknown Date';
    }

    protected function getLessonById(int $lessonId)
    {
        /** @var LessonRepository $repo */
        $repo = GeneralUtility::makeInstance(LessonRepository::class);
        return $repo->findByIdentifier($lessonId);
    }
}