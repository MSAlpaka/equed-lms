<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class InstructorRatingViewHelper extends AbstractViewHelper
{
    /**
     * @param int $instructorId
     * @return string
     */
    public function render(int $instructorId): string
    {
        // Fetch instructor rating
        $rating = $this->getInstructorRating($instructorId);
        return $rating ? "$rating/5" : "No rating available";
    }

    /**
     * Fetch the instructor's rating by ID
     *
     * @param int $instructorId
     * @return float|null
     */
    protected function getInstructorRating(int $instructorId): ?float
    {
        // Fetch the instructor from the repository
        $repository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\Equed\EquedLms\Domain\Repository\InstructorRepository::class);
        $instructor = $repository->findByUid($instructorId);
        return $instructor ? $instructor->getRating() : null;
    }
}