<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class InstructorAvailabilityViewHelper extends AbstractViewHelper
{
    /**
     * @param int $instructorId
     * @return string
     */
    public function render(int $instructorId): string
    {
        // Fetch instructor availability status
        $availability = $this->getInstructorAvailability($instructorId);
        return $availability ? 'Available' : 'Not Available';
    }

    /**
     * Get the availability status of an instructor
     *
     * @param int $instructorId
     * @return bool
     */
    protected function getInstructorAvailability(int $instructorId): bool
    {
        // Logic to fetch instructor availability from the repository
        $repository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\Equed\EquedLms\Domain\Repository\InstructorRepository::class);
        $instructor = $repository->findByUid($instructorId);
        return $instructor ? $instructor->getAvailable() : false;
    }
}