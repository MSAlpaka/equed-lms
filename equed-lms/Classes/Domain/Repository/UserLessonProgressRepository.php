<?php
namespace Equed\EquedLms\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;
use Equed\EquedLms\Domain\Model\UserLessonProgress;

class UserLessonProgressRepository extends Repository
{
    /**
     * Find or create a progress record for a given user and lesson.
     */
    public function findOrCreateByFeUserAndLesson(int $feUser, int $lesson): UserLessonProgress
    {
        $query = $this->createQuery();
        $query->matching(
            $query->logicalAnd(
                $query->equals('feUser', $feUser),
                $query->equals('lesson', $lesson)
            )
        );
        $existing = $query->execute()->getFirst();
        if ($existing instanceof UserLessonProgress) {
            return $existing;
        }

        $new = new UserLessonProgress();
        $new->setFeUser($feUser);
        $new->setLesson($lesson);
        $this->add($new);
        return $new;
    }

    /**
     * Finds all progress entries for a given frontend user.
     *
     * @param int $feUser
     * @return array<int, UserLessonProgress> indexed by lesson uid
     */
    public function findByFeUser(int $feUser): array
    {
        $query = $this->createQuery();
        $query->matching(
            $query->equals('feUser', $feUser)
        );
        $result = [];
        foreach ($query->execute() as $entry) {
            $result[$entry->getLesson()] = $entry;
        }
        return $result;
    }
}