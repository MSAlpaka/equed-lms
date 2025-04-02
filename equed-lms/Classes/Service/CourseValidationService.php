<?php

declare(strict_types=1);

namespace Equed\EquedLms\Service;

use Equed\EquedLms\Domain\Model\UserCourseRecord;
use Equed\EquedLms\Domain\Repository\CourseRepository;

class CourseValidationService
{
    /**
     * @var CourseRepository
     */
    protected $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    /**
     * Überprüft die Voraussetzungen für die Kursbuchung
     *
     * @param UserCourseRecord $userCourseRecord
     * @return bool
     */
    public function checkPrerequisites(UserCourseRecord $userCourseRecord): bool
    {
        $course = $userCourseRecord->getCourse();
        $finishGoal = $course->getFinishGoal();

        // Holen der Voraussetzungen des Kurses
        $prerequisites = $course->getPrerequisites();

        // Prüfen, ob der Teilnehmer alle notwendigen Abschlussziele erfüllt hat
        foreach ($prerequisites as $prerequisite) {
            if (!in_array($prerequisite, $userCourseRecord->getCompletedGoals())) {
                return false; // Voraussetzung nicht erfüllt
            }
        }

        return true; // Alle Voraussetzungen sind erfüllt
    }
}