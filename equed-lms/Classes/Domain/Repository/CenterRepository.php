<?php

namespace Equed\EquedLms\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;

class CenterRepository extends Repository
{
    /**
     * Find all centers by country
     */
    public function findByCountry(string $country): array
    {
        $query = $this->createQuery();

        return $query
            ->matching(
                $query->equals('country', $country)
            )
            ->execute()
            ->toArray();
    }

    /**
     * Find all centers with a specific certifier
     */
    public function findByCertifier(int $certifierId): array
    {
        $query = $this->createQuery();

        return $query
            ->matching(
                $query->equals('certifier', $certifierId)
            )
            ->execute()
            ->toArray();
    }

    /**
     * Find all active centers
     */
    public function findAllActive(): array
    {
        $query = $this->createQuery();

        return $query
            ->matching(
                $query->equals('active', true)
            )
            ->execute()
            ->toArray();
    }
}