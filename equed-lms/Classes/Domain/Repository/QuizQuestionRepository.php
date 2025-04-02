<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;

class QuizQuestionRepository extends Repository
{
    /**
     * Finde alle Fragen zu einer bestimmten Lektion
     *
     * @param int $lessonId
     * @return array
     */
    public function findByLesson(int $lessonId): array
    {
        $query = $this->createQuery();
        $query->matching(
            $query->equals('lesson', $lessonId)
        );
        return $query->execute()->toArray();
    }

    /**
     * Finde alle sichtbaren Fragen
     *
     * @return array
     */
    public function findVisible(): array
    {
        $query = $this->createQuery();
        $query->matching(
            $query->equals('hidden', 0)
        );
        return $query->execute()->toArray();
    }

    /**
     * Fragen nach Schwierigkeitsgrad
     *
     * @param string $level
     * @return array
     */
    public function findByDifficulty(string $level): array
    {
        $query = $this->createQuery();
        $query->matching(
            $query->equals('difficulty', $level)
        );
        return $query->execute()->toArray();
    }
}