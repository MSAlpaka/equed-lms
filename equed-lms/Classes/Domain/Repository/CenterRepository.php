<?php
namespace Equed\EquedLms\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;
use Equed\EquedLms\Domain\Model\Center;

/**
 * Repository für das Center-Modell
 */
class CenterRepository extends Repository
{
    /**
     * Findet ein Center basierend auf der Center-ID
     *
     * @param string $centerId
     * @return Center|null
     */
    public function findByCenterId(string $centerId): ?Center
    {
        $query = $this->createQuery();
        $query->matching($query->equals('centerId', $centerId));
        return $query->execute()->getFirst();
    }

    /**
     * Findet alle verfügbaren Center
     *
     * @return Center[]
     */
    public function findAllCenters(): array
    {
        return $this->findAll()->toArray();
    }
}