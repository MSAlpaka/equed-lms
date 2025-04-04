<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Repository;

use Equed\EquedLms\Domain\Model\Certificate;
use Equed\EquedLms\Domain\Model\UserCourseRecord;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for Certificate entities
 */
class CertificateRepository extends Repository
{
    /**
     * Default sorting: newest first
     *
     * @var array<string, int>
     */
    protected $defaultOrderings = [
        'issuedAt' => QueryInterface::ORDER_DESCENDING,
    ];

    /**
     * Find a certificate by its unique code
     *
     * @param string $code
     * @return Certificate|null
     */
    public function findByCode(string $code): ?Certificate
    {
        return $this->createQuery()
            ->matching(
                $this->createQuery()->equals('code', $code)
            )
            ->execute()
            ->getFirst();
    }

    /**
     * Find a certificate based on the UserCourseRecord
     *
     * @param UserCourseRecord $record
     * @return Certificate|null
     */
    public function findByUserCourseRecord(UserCourseRecord $record): ?Certificate
    {
        return $this->createQuery()
            ->matching(
                $this->createQuery()->equals('userCourseRecord', $record)
            )
            ->execute()
            ->getFirst();
    }

    /**
     * Find all certificates issued to a given user
     *
     * @param FrontendUser $user
     * @return Certificate[]
     */
    public function findAllByUser(FrontendUser $user): array
    {
        return $this->createQuery()
            ->matching(
                $this->createQuery()->equals('userCourseRecord.user', $user)
            )
            ->execute()
            ->toArray();
    }

    /**
     * Find the latest certificate issued to a user
     *
     * @param FrontendUser $user
     * @return Certificate|null
     */
    public function findLatestByUser(FrontendUser $user): ?Certificate
    {
        $query = $this->createQuery();
        $query->matching(
            $query->equals('userCourseRecord.user', $user)
        );
        $query->setOrderings(['issuedAt' => QueryInterface::ORDER_DESCENDING]);
        $query->setLimit(1);
        return $query->execute()->getFirst();
    }
}