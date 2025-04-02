<?php

namespace Equed\EquedLms\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;

class AuditLogRepository extends Repository
{
    /**
     * Find all audit logs for a specific user
     */
    public function findByUser(int $userId): array
    {
        $query = $this->createQuery();

        return $query
            ->matching(
                $query->equals('feUser', $userId)
            )
            ->execute()
            ->toArray();
    }

    /**
     * Find audit logs by action type
     */
    public function findByAction(string $action): array
    {
        $query = $this->createQuery();

        return $query
            ->matching(
                $query->equals('action', $action)
            )
            ->execute()
            ->toArray();
    }

    /**
     * Find all audit logs for a specific related entity (ID and type)
     */
    public function findByRelatedEntity(int $relatedId, string $relatedType): array
    {
        $query = $this->createQuery();

        return $query
            ->matching(
                $query->logicalAnd([
                    $query->equals('relatedId', $relatedId),
                    $query->equals('relatedType', $relatedType),
                ])
            )
            ->execute()
            ->toArray();
    }
}