<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Repository;

use Equed\EquedLms\Domain\Model\QmsCase;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for QMS cases
 */
class QmsCaseRepository extends Repository
{
    /**
     * Find a QMS case by its ID
     *
     * @param int $id
     * @return QmsCase|null
     */
    public function findByUid(int $id): ?QmsCase
    {
        return $this->findByIdentifier($id);
    }

    /**
     * Add a QMS case to the repository
     *
     * @param QmsCase $qmsCase
     */
    public function add(QmsCase $qmsCase): void
    {
        $this->addObject($qmsCase);
    }

    /**
     * Remove a QMS case from the repository
     *
     * @param QmsCase $qmsCase
     */
    public function remove(QmsCase $qmsCase): void
    {
        $this->removeObject($qmsCase);
    }
}
