<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;

class ExamAttemptRepository extends Repository
{
    /**
     * @param int $recordId
     * @return array
     */
    public function findByUserCourseRecord(int $recordId): array
    {
        return $this->createQuery()
            ->matching(
                $this->createQuery()->equals('record', $recordId)
            )
            ->execute()
            ->toArray();
    }

    /**
     * @param int $recordId
     * @param string $type 'theory', 'practical', 'case'
     * @return array
     */
    public function findAttemptsByType(int $recordId, string $type): array
    {
        $query = $this->createQuery();
        return $query
            ->matching(
                $query->logicalAnd([
                    $query->equals('record', $recordId),
                    $query->equals('type', $type),
                ])
            )
            ->execute()
            ->toArray();
    }
}