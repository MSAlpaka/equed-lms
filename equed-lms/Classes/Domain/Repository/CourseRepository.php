<?php
namespace Equed\EquedLms\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;

class CourseRepository extends Repository
{
    /**
     * Alle aktiven Kurse abrufen
     *
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findActiveCourses()
    {
        $query = $this->createQuery();
        $query->matching(
            $query->equals('isActive', 1)
        );
        return $query->execute();
    }

    /**
     * Kurse nach Kategorie suchen
     *
     * @param string $category
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findCoursesByCategory($category)
    {
        $query = $this->createQuery();
        $query->matching(
            $query->equals('category', $category)
        );
        return $query->execute();
    }

    /**
     * Kurse mit Abschlussziel filtern
     *
     * @param string $finishGoal
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findCoursesByFinishGoal($finishGoal)
    {
        $query = $this->createQuery();
        $query->matching(
            $query->equals('finishGoal', $finishGoal)
        );
        return $query->execute();
    }
}