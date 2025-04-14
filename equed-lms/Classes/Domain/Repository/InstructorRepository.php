<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Repository;

use Equed\EquedLms\Domain\Model\Instructor;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for Instructor entities
 */
class InstructorRepository extends Repository
{
    /**
     * Find all verified instructors
     *
     * @return Instructor[]
     */
    public function findAllVerified(): array
    {
        $query = $this->createQuery();
        return $query
            ->matching($query->equals('verified', true))
            ->execute()
            ->toArray();
    }

    /**
     * Find instructors with a specific specialty (substring match)
     *
     * @param string $specialty
     * @return Instructor[]
     */
    public function findBySpecialty(string $specialty): array
    {
        $query = $this->createQuery();
        return $query
            ->matching($query->like('specialties', '%' . $specialty . '%'))
            ->execute()
            ->toArray();
    }

    /**
     * Find instructor by frontend user ID
     *
     * @param int $feUserId
     * @return Instructor|null
     */
    public function findOneByUserId(int $feUserId): ?Instructor
    {
        $query = $this->createQuery();
        return $query
            ->matching($query->equals('user', $feUserId))
            ->setLimit(1)
            ->execute()
            ->getFirst();
    }
}