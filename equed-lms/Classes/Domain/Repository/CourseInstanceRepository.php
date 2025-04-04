<?php

declare(strict_types=1);

namespace EquedLms\Domain\Repository;

use DateTimeImmutable;
use EquedLms\Domain\Model\CourseInstance;
use EquedLms\Domain\Model\CourseProgram;
use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;

/**
 * Repository for CourseInstance entities
 */
class CourseInstanceRepository extends Repository
{
    /**
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
     * Find all instances at a specific center
     *
     * @param int $centerUid
     * @return CourseInstance[]
     */
    public function findByCenter(int $centerUid): array
    {
        return $this->createQuery()
            ->matching(
                $this->createQuery()->equals('center', $centerUid)
            )
            ->execute()
            ->toArray();
    }

    /**
     * Find all upcoming course instances starting today or later
     *
     * @return CourseInstance[]
     */
    public function findUpcoming(): array
    {
        return $this->createQuery()
            ->matching(
                $this->createQuery()->greaterThanOrEqual('startDate', new DateTimeImmutable('today'))
            )
            ->execute()
            ->toArray();
    }

    /**
     * Find all course instances assigned to a specific instructor
     *
     * @param int $userUid
     * @return CourseInstance[]
     */
    public function findByInstructor(int $userUid): array
    {
        return $this->createQuery()
            ->matching(
                $this->createQuery()->contains('instructors', $userUid)
            )
            ->execute()
            ->toArray();
    }

    /**
     * Find all fully booked course instances
     *
     * @return array
     */
    public function findFullyBooked(): array
    {
        return $this->createQuery()
            ->statement(
                'SELECT * FROM tx_equedlms_domain_model_courseinstance ci
                 WHERE max_participants > 0 AND (
                     SELECT COUNT(*) FROM tx_equedlms_domain_model_usercourserecord ucr
                     WHERE ucr.course_instance = ci.uid
                 ) >= ci.max_participants'
            )
            ->execute(true);
    }
}