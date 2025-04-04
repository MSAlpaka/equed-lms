<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Repository;

use Equed\EquedLms\Domain\Model\Certificate;
use Equed\EquedLms\Domain\Model\UserCourseRecord;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository für Zertifikate
 */
class CertificateRepository extends Repository
{
    protected $defaultOrderings = [
        'issuedAt' => QueryInterface::ORDER_DESCENDING,
    ];

    /**
     * Find a certificate by its unique code.
     */
    public function findByCode(string $code): ?Certificate
    {
        $query = $this->createQuery();
        $query->matching($query->equals('code', $code));
        return $query->execute()->getFirst();
    }

    /**
     * Find a certificate based on the UserCourseRecord.
     */
    public function findByUserCourseRecord(UserCourseRecord $record): ?Certificate
    {
        $query = $this->createQuery();
        $query->matching($query->equals('userCourseRecord', $record));
        return $query->execute()->getFirst();
    }

    /**
     * Find all certificates issued to a given user.
     *
     * @return Certificate[]
     */
    public function findAllByUser(FrontendUser $user): array
    {
        $query = $this->createQuery();
        $query->matching($query->equals('userCourseRecord.user', $user));
        return $query->execute()->toArray();
    }

    /**
     * Find the latest certificate issued to a user.
     */
    public function findLatestByUser(FrontendUser $user): ?Certificate
    {
        $query = $this->createQuery();
        $query->matching($query->equals('userCourseRecord.user', $user));
        $query->setOrderings(['issuedAt' => QueryInterface::ORDER_DESCENDING]);
        $query->setLimit(1);
        return $query->execute()->getFirst();
    }
}