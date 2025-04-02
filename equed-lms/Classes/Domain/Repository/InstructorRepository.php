<?php

namespace Equed\EquedLms\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;

class InstructorRepository extends Repository
{
    /**
     * Find all verified instructors
     */
    public function findAllVerified(): array
    {
        $query = $this->createQuery();
        return $query
            ->matching(
                $query->equals('verified', true)
            )
            ->execute()
            ->toArray();
    }

    /**
     * Find instructors with a specific specialty (substring match)
     */
    public function findBySpecialty(string $specialty): array
    {
        $query = $this->createQuery();

        return $query
            ->matching(
                $query->like('specialties', '%' . $specialty . '%')
            )
            ->execute()
            ->toArray();
    }

    /**
     * Find instructor by frontend user ID
     */
    public function findOneByUserId(int $feUserId): ?object
    {
        $query = $this->createQuery();

        $result = $query
            ->matching(
                $query->equals('user', $feUserId)
            )
            ->setLimit(1)
            ->execute();

        return $result->getFirst();
    }
}