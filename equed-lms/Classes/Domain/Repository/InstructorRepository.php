<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;
use Equed\EquedLms\Domain\Model\Instructor;

class InstructorRepository extends Repository
{
    /**
     * Finde alle Instructoren basierend auf dem Abschlussziel
     *
     * @param string $finishGoal
     * @return Instructor[]
     */
    public function findByFinishGoal(string $finishGoal): array
    {
        $query = $this->createQuery();
        $query->matching(
            $query->like('finishGoal', '%' . $finishGoal . '%')
        );

        return $query->execute()->toArray();
    }
}