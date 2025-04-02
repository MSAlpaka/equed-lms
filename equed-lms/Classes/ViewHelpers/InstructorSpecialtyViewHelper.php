<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class InstructorSpecialtyViewHelper extends AbstractViewHelper
{
    /**
     * @param int $instructorId
     * @return string
     */
    public function render(int $instructorId): string
    {
        // Fetch instructor specialty
        $specialty = $this->getInstructorSpecialty($instructorId);
        return $specialty ? $specialty : 'No specialty available';
    }

    /**
     * Get the specialty of the instructor
     *
     * @param int $instructorId
     * @return string|null
     */
    protected function getInstructorSpecialty(int $instructorId): ?string
    {
        $repository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\Equed\EquedLms\Domain\Repository\InstructorRepository::class);
        $instructor = $repository->findByUid($instructorId);
        return $instructor ? $instructor->getSpecialty() : null;
    }
}