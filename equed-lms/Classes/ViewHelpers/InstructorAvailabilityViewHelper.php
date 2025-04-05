<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Equed\EquedLms\Domain\Repository\InstructorRepository;

class InstructorAvailabilityViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('instructorId', 'int', 'Instructor UID', true);
    }

    public function render(): string
    {
        $instructorId = (int)$this->arguments['instructorId'];
        $available = $this->getInstructorAvailability($instructorId);

        $key = $available ? 'instructor.available' : 'instructor.not_available';
        return LocalizationUtility::translate($key, 'equed_lms') ?? ($available ? 'Available' : 'Not Available');
    }

    protected function getInstructorAvailability(int $instructorId): bool
    {
        /** @var InstructorRepository $repository */
        $repository = GeneralUtility::makeInstance(InstructorRepository::class);
        $instructor = $repository->findByUid($instructorId);

        return $instructor ? (bool)$instructor->getAvailable() : false;
    }
}