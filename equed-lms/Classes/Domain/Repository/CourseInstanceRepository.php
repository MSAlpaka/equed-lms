<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Repository;

use DateTimeImmutable;
use Equed\EquedLms\Domain\Model\CourseInstance;
use Equed\EquedLms\Domain\Model\CourseProgram;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for CourseInstance entities
 */
class CourseInstanceRepository extends Repository
{
    /**
     * Default ordering: sort by startDate ascending
     *
     * @var array<string, int>
     */
    protected $defaultOrderings = [
        'startDate' => QueryInterface::ORDER_ASCENDING,
    ];

    /**
     * Find all public course instances of a specific program
     *
     * @param CourseProgram $program
     * @return CourseInstance[]
     */
    public function findPublicByProgram(CourseProgram $program): array
    {
        $query = $this->createQuery();
        return $query
            ->matching(
                $query->logicalAnd([
                    $query->equals('program', $program),
                    $query->equals('isPublic', true),
                ])
            )
            ->execute()
            ->toArray();
    }

    /**
     * Find all CourseInstances where the given FrontendUser is assigned as instructor
     *
     * @param FrontendUser $user
     * @return CourseInstance[]
     */
    public function findByInstructor(FrontendUser $user): array
    {
        $query = $this->createQuery();
        return $query
            ->matching(
                $query->contains('instructors', $user)
            )
            ->execute()
            ->toArray();
    }
}