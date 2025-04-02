<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class InstructorProfileViewHelper extends AbstractViewHelper
{
    /**
     * @param int $instructorId
     * @return string
     */
    public function render(int $instructorId): string
    {
        // Fetch instructor profile
        $instructor = $this->getInstructorProfile($instructorId);
        return $instructor ? $instructor->getName() : 'Instructor Not Found';
    }

    /**
     * Fetch instructor profile data by ID
     *
     * @param int $instructorId
     * @return \Equed\EquedLms\Domain\Model\Instructor|null
     */
    protected function getInstructorProfile(int $instructorId)
    {
        $repository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\Equed\EquedLms\Domain\Repository\InstructorRepository::class);
        return $repository->findByUid($instructorId);
    }
}