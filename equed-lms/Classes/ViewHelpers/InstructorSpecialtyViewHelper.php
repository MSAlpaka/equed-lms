<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Equed\EquedLms\Domain\Repository\InstructorRepository;

class InstructorSpecialtyViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('instructorId', 'int', 'Instructor UID', true);
    }

    public function render(): string
    {
        $instructorId = (int)$this->arguments['instructorId'];
        $specialty = $this->getInstructorSpecialty($instructorId);

        return $specialty
            ?? LocalizationUtility::translate('instructor.no_specialty', 'equed_lms')
            ?? 'No specialty available';
    }

    protected function getInstructorSpecialty(int $instructorId): ?string
    {
        /** @var InstructorRepository $repository */
        $repository = GeneralUtility::makeInstance(InstructorRepository::class);
        $instructor = $repository->findByUid($instructorId);

        return $instructor?->getSpecialty();
    }
}