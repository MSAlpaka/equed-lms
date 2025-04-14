<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Repository;

use Equed\EquedLms\Domain\Model\UserCourseRecord;
use TYPO3\CMS\Extbase\Persistence\Repository;

class UserCourseRecordRepository extends Repository
{
    /**
     * @param int $userId
     * @return UserCourseRecord[]
     */
    public function findByUser(int $userId): array
    {
        $query = $this->createQuery();
        return $query
            ->matching($query->equals('user', $userId))
            ->execute()
            ->toArray();
    }

    /**
     * @param int $courseInstanceId
     * @return UserCourseRecord[]
     */
    public function findByCourseInstance(int $courseInstanceId): array
    {
        $query = $this->createQuery();
        return $query
            ->matching($query->equals('courseInstance', $courseInstanceId))
            ->execute()
            ->toArray();
    }

    /**
     * @param int $userId
     * @param int $instanceId
     * @return UserCourseRecord|null
     */
    public function findOneByUserAndCourseInstance(int $userId, int $instanceId): ?UserCourseRecord
    {
        $query = $this->createQuery();
        return $query
            ->matching($query->logicalAnd([
                $query->equals('user', $userId),
                $query->equals('courseInstance', $instanceId),
            ]))
            ->execute()
            ->getFirst();
    }

    /**
     * @param int $userId
     * @param int $programId
     * @return array
     */
    public function findByUserAndProgram(int $userId, int $programId): array
    {
        $query = $this->createQuery();
        $query->statement(
            'SELECT ucr.* FROM tx_equedlms_domain_model_usercourserecord ucr
             INNER JOIN tx_equedlms_domain_model_courseinstance ci ON ucr.course_instance = ci.uid
             WHERE ucr.user = ' . (int)$userId . ' AND ci.program = ' . (int)$programId
        );
        return $query->execute(true);
    }
}