<?php
namespace Equed\EquedLms\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;

class LessonRepository extends Repository
{
    /**
     * Alle Lektionen zu einem Kurs abrufen
     *
     * @param \Equed\EquedLms\Domain\Model\Course $course
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findLessonsByCourse(\Equed\EquedLms\Domain\Model\Course $course)
    {
        $query = $this->createQuery();
        $query->matching(
            $query->equals('course', $course)
        );
        $query->setOrderings(['position' => QueryInterface::ORDER_ASCENDING]);  // Sortierung nach Position
        return $query->execute();
    }

    /**
     * Alle Lektionen anzeigen, die nicht versteckt sind
     *
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findVisibleLessons()
    {
        $query = $this->createQuery();
        $query->matching(
            $query->equals('hidden', 0)
        );
        return $query->execute();
    }

    /**
     * Eine Lektion nach ihrem Slug finden (SEO-Zwecke)
     *
     * @param string $slug
     * @return \Equed\EquedLms\Domain\Model\Lesson|null
     */
    public function findLessonBySlug($slug)
    {
        $query = $this->createQuery();
        $query->matching(
            $query->equals('slug', $slug)
        );
        return $query->execute()->getFirst();
    }
}