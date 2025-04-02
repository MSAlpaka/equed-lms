<?php
namespace Equed\EquedLms\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use Equed\EquedLms\Domain\Repository\UserLessonProgressRepository;
use Equed\EquedLms\Domain\Repository\CourseRepository;

class ProgressViewHelper extends AbstractViewHelper
{
    protected ObjectManager $objectManager;

    public function initializeArguments(): void
    {
        $this->registerArgument('courseId', 'int', 'UID des Kurses', true);
        $this->registerArgument('feUserId', 'int', 'UID des FE-Benutzers', false);
    }

    public function render(): int
    {
        $courseId = $this->arguments['courseId'];
        $feUserId = $this->arguments['feUserId'] ?? $GLOBALS['TSFE']->fe_user->user['uid'] ?? 0;

        if ($feUserId <= 0) {
            return 0;
        }

        /** @var UserLessonProgressRepository $progressRepo */
        $progressRepo = $this->objectManager->get(UserLessonProgressRepository::class);
        /** @var CourseRepository $courseRepo */
        $courseRepo = $this->objectManager->get(CourseRepository::class);

        $course = $courseRepo->findByIdentifier($courseId);
        if ($course === null) {
            return 0;
        }

        $lessons = $course->getLessons();
        if ($lessons->count() === 0) {
            return 100;
        }

        $completed = 0;
        foreach ($lessons as $lesson) {
            $progress = $progressRepo->findOrCreateByFeUserAndLesson($feUserId, $lesson->getUid());
            if ($progress->isCompleted()) {
                $completed++;
            }
        }

        return (int) round(($completed / $lessons->count()) * 100);
    }
}