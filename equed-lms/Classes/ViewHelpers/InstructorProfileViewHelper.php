<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Equed\EquedLms\Domain\Repository\InstructorRepository;

class InstructorProfileViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('instructorId', 'int', 'Instructor UID', true);
    }

    public function render(): string
    {
        $instructorId = (int)$this->arguments['instructorId'];
        $instructor = $this->getInstructorProfile($instructorId);

        return $instructor?->getName()
            ?? LocalizationUtility::translate('instructor.not_found', 'equed_lms')
            ?? 'Instructor Not Found';
    }

    protected function getInstructorProfile(int $instructorId)
    {
        /** @var InstructorRepository $repository */
        $repository = GeneralUtility::makeInstance(InstructorRepository::class);
        return $repository->findByUid($instructorId);
    }
}