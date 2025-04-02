<?php

namespace Equed\EquedLms\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use Equed\EquedLms\Domain\Model\AuditLog;

class AuditLogRepository extends Repository
{
    public function __construct(
        protected PersistenceManager $persistenceManager
    ) {}

    public function log(
        int $feUserId,
        string $action,
        string $relatedType = '',
        int $relatedId = 0,
        string $comment = ''
    ): void {
        $log = new AuditLog();
        $log->setFeUser($feUserId);
        $log->setAction($action);
        $log->setRelatedType($relatedType);
        $log->setRelatedId($relatedId);
        $log->setComment($comment);
        $log->setTimestamp(new \DateTime());

        $this->add($log);
        $this->persistenceManager->persistAll();
    }

    public function findByUser(int $feUserId): array
    {
        return $this->createQuery()
            ->matching(
                $this->createQuery()->equals('feUser', $feUserId)
            )
            ->execute()
            ->toArray();
    }

    public function findRecent(int $limit = 50): array
    {
        return $this->createQuery()
            ->setOrderings(['timestamp' => QueryInterface::ORDER_DESCENDING])
            ->setLimit($limit)
            ->execute()
            ->toArray();
    }
}