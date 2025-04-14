<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Repository;

use Equed\EquedLms\Domain\Model\AuditLog;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for AuditLog entities
 */
class AuditLogRepository extends Repository
{
    /**
     * Find all audit logs for a specific user
     *
     * @param int $userId
     * @return AuditLog[]
     */
    public function findByUser(int $userId): array
    {
        $query = $this->createQuery();
        return $query
            ->matching($query->equals('feUser', $userId))
            ->execute()
            ->toArray();
    }

    /**
     * Find audit logs by action type
     *
     * @param string $action
     * @return AuditLog[]
     */
    public function findByAction(string $action): array
    {
        $query = $this->createQuery();
        return $query
            ->matching($query->equals('action', $action))
            ->execute()
            ->toArray();
    }

    /**
     * Find all audit logs for a specific related entity (e.g., course, submission)
     *
     * @param int $relatedId
     * @param string $relatedType
     * @return AuditLog[]
     */
    public function findByRelatedEntity(int $relatedId, string $relatedType): array
    {
        $query = $this->createQuery();
        return $query
            ->matching($query->logicalAnd([
                $query->equals('relatedId', $relatedId),
                $query->equals('relatedType', $relatedType),
            ]))
            ->execute()
            ->toArray();
    }
}