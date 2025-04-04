<?php

declare(strict_types=1);

namespace EquedLms\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;

class UserCourseRecordRepository extends Repository
{
    /**
     * Finde alle Einträge eines bestimmten Users
     */
    public function findByUser(int $userId): array
    {
        $query = $this->createQuery();
        $query->matching(
            $query->equals('user', $userId)
        );
        return $query->execute()->toArray();
    }

    /**
     * Finde alle Einträge zu einer bestimmten Kursinstanz
     */
    public function findByCourseInstance(int $courseInstanceId): array
    {
        $query = $this->createQuery();
        $query->matching(
            $query->equals('courseInstance', $courseInstanceId)
        );
        return $query->execute()->toArray();
    }

    /**
     * Finde ein bestimmtes Kursrecord (z. B. zum Verhindern von Mehrfachbuchung)
     */
    public function findOneByUserAndCourseInstance(int $userId, int $instanceId): ?object
    {
        $query = $this->createQuery();
        $query->matching(
            $query->logicalAnd([
                $query->equals('user', $userId),
                $query->equals('courseInstance', $instanceId),
            ])
        );
        return $query->execute()->getFirst();
    }

    /**
     * Finde Einträge nach Programm (über Umweg: courseInstance.program)
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