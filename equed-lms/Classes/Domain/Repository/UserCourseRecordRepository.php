<?php

namespace Equed\EquedLms\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;

class UserCourseRecordRepository extends Repository
{
    public function findByUserAndCourse(int $userId, int $courseId): ?object
    {
        $query = $this->createQuery();
        $result = $query->matching(
            $query->logicalAnd([
                $query->equals('feUser', $userId),
                $query->equals('course', $courseId)
            ])
        )->execute();

        return $result->getFirst();
    }

    public function findValidated(): array
    {
        return $this->createQuery()
            ->matching(
                $this->createQuery()->equals('completionValidated', true)
            )
            ->execute()
            ->toArray();
    }

    public function findByUser(int $userId): array
    {
        return $this->createQuery()
            ->matching(
                $this->createQuery()->equals('feUser', $userId)
            )
            ->execute()
            ->toArray();
    }
    public function findPendingValidations(): \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
    {
        $query = $this->createQuery();

        $constraints = $query->logicalAnd(
            $query->equals('completionConfirmed', true),
            $query->equals('completionValidated', false)
    );

        return $query->matching($constraints)->execute();
    }
    public function findByFeUserAndValidated(int $userId): \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
    {
        $query = $this->createQuery();
        return $query->matching(
            $query->logicalAnd(
                $query->equals('feUser', $userId),
                $query->equals('completionValidated', true)
        )
    )->execute();
    }
    public function findOneByCertificateCode(string $code): ?\Equed\EquedLms\Domain\Model\UserCourseRecord
    {
    $query = $this->createQuery();
    return $query->matching(
        $query->equals('certificateCode', $code)
    )->execute()->getFirst();
    }
}