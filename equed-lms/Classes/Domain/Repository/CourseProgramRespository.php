<?php

declare(strict_types=1);

namespace EquedLms\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;

class CourseProgramRepository extends Repository
{
    protected $defaultOrderings = [
        'title' => QueryInterface::ORDER_ASCENDING,
    ];

    /**
     * Finde alle Programme, die mindestens eine öffentliche Instanz haben
     */
    public function findWithPublicInstances(): array
    {
        $query = $this->createQuery();

        // Custom Query für bessere Performance (kann bei Bedarf durch QueryBuilder ersetzt werden)
        $query->statement(
            'SELECT DISTINCT p.* FROM tx_equedlms_domain_model_courseprogram p
             INNER JOIN tx_equedlms_domain_model_courseinstance i ON i.program = p.uid
             WHERE i.is_public = 1'
        );

        return $query->execute(true);
    }

    /**
     * Finde ein einzelnes Programm anhand des Slugs
     */
    public function findOneBySlug(string $slug): ?array
    {
        $query = $this->createQuery();
        $query->matching(
            $query->equals('slug', $slug)
        );
        $result = $query->execute()->toArray();
        return $result[0] ?? null;
    }

    /**
     * Optional: Finde alle Programme mit mind. einer aktiven Instanz (zukünftiger Termin)
     */
    public function findActivePrograms(): array
    {
        $query = $this->createQuery();
        $query->statement(
            'SELECT DISTINCT p.* FROM tx_equedlms_domain_model_courseprogram p
             INNER JOIN tx_equedlms_domain_model_courseinstance i ON i.program = p.uid
             WHERE i.start_date >= CURRENT_DATE()'
        );

        return $query->execute(true);
    }
}