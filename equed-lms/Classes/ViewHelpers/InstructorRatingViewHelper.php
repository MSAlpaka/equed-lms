<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Equed\EquedLms\Domain\Repository\InstructorRepository;

class InstructorRatingViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('instructorId', 'int', 'ID des Instructors', true);
    }

    public function render(): string
    {
        $instructorId = (int)$this->arguments['instructorId'];
        $rating = $this->getInstructorRating($instructorId);

        if ($rating === null) {
            return LocalizationUtility::translate('instructor.no_rating', 'equed_lms') ?? 'No rating available';
        }

        return sprintf('%s/5', $rating);
    }

    /**
     * Ermittelt die Bewertung eines Instructors.
     *
     * @param int $instructorId
     * @return float|null
     */
    protected function getInstructorRating(int $instructorId): ?float
    {
        /** @var InstructorRepository $repository */
        $repository = GeneralUtility::makeInstance(InstructorRepository::class);
        $instructor = $repository->findByIdentifier($instructorId);

        if ($instructor && method_exists($instructor, 'getRating')) {
            return $instructor->getRating();
        }
        return null;
    }
}