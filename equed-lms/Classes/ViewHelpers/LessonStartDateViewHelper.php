<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class LessonStartDateViewHelper extends AbstractViewHelper
{
    /**
     * @param int $lessonId
     * @return string
     */
    public function render(int $lessonId): string
    {
        // Fetch lesson start date
        $lesson = $this->getLessonById($lessonId);
        return $lesson ? $lesson->getStartDate()->format('F j, Y') : 'Unknown Date';
    }

    /**
     * Fetch lesson data by ID
     *
     * @param int $lessonId
     * @return \Equed\EquedLms\Domain\Model\Lesson|null
     */
    protected function getLessonById(int $lessonId)
    {
        $lessonRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\Equed\EquedLms\Domain\Repository\LessonRepository::class);
        return $lessonRepository->findByIdentifier($lessonId);
    }
}