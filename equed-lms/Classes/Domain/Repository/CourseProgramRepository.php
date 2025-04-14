<?php

declare(strict_types=1);

namespace EquedLms\Domain\Repository;

use EquedLms\Domain\Model\CourseProgram;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for CourseProgram entities
 */
class CourseProgramRepository extends Repository
{
    /**
     * Default ordering: alphabetical by title
     *
     * @var array<string, int>
     */
    protected $defaultOrderings = [
        'title' => QueryInterface::ORDER_ASCENDING,
    ];

    /**
     * Returns all programs that have at least one public instance
     *
     * @return array<int, array<string, mixed>> raw DB results
     */
    public function findWithPublicInstances(): array
    {
        $query = $this->createQuery();

        $query->statement(
            'SELECT DISTINCT p.* FROM tx_equedlms_domain_model_courseprogram p
             INNER JOIN tx_equedlms_domain_model_courseinstance i ON i.program = p.uid
             WHERE i.is_public = 1'
        );

        return $query->execute(true); // raw array
    }

    /**
     * Find one program by its slug
     *
     * @param string $slug
     * @return CourseProgram|null
     */
    public function findOneBySlug(string $slug): ?CourseProgram
    {
        return $this->createQuery()
            ->matching(
                $this->createQuery()->equals('slug', $slug)
            )
            ->execute()
            ->getFirst();
    }
}