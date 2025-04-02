<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class CourseStartDateViewHelper extends AbstractViewHelper
{
    /**
     * @param int $courseId
     * @return string
     */
    public function render(int $courseId): string
    {
        // Fetch the course start date
        $course = $this->getCourseById($courseId);
        return $course ? $this->formatDate($course->getStartDate()) : 'Unknown Start Date';
    }

    /**
     * Format the date to a human-readable format
     *
     * @param \DateTime $date
     * @return string
     */
    protected function formatDate(\DateTime $date): string
    {
        return $date->format('F j, Y');
    }

    /**
     * Fetch course data by ID
     *
     * @param int $courseId
     * @return \Equed\EquedLms\Domain\Model\Course|null
     */
    protected function getCourseById(int $courseId)
    {
        $courseRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\Equed\EquedLms\Domain\Repository\CourseRepository::class);
        return $courseRepository->findByIdentifier($courseId);
    }
}