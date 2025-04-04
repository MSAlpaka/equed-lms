<?php

namespace Equed\EquedLms\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;
use Equed\EquedLms\Domain\Model\Center;

/**
 * Repository for Center entities
 */
class CenterRepository extends Repository
{
    /**
     * Find all centers by country
     *
     * @param string $country
     * @return Center[]
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
     *
     * @param int $certifierId
     * @return Center[]
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
     *
     * @return Center[]
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