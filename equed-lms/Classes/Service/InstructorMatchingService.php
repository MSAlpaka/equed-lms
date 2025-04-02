<?php

declare(strict_types=1);

namespace Equed\EquedLms\Service;

use Equed\EquedLms\Domain\Model\UserCourseRecord;
use Equed\EquedLms\Domain\Model\User;
use Equed\EquedLms\Domain\Repository\InstructorRepository;

class InstructorMatchingService
{
    /**
     * @var InstructorRepository
     */
    protected $instructorRepository;

    public function __construct(InstructorRepository $instructorRepository)
    {
        $this->instructorRepository = $instructorRepository;
    }

    /**
     * Zuweisung der Instructor-Rolle
     *
     * @param UserCourseRecord $userCourseRecord
     */
    public function assignInstructorRole(UserCourseRecord $userCourseRecord)
    {
        $user = $userCourseRecord->getUser();
        $finishGoal = $userCourseRecord->getCourse()->getFinishGoal();

        // Wenn der Kurs das Ziel 'HoofCare for Donkeys' erreicht hat, wird dem User die Rolle zugewiesen
        if ($finishGoal === 'specialty_instructor_hoofcare_for_donkeys') {
            $user->addRole('Instructor for HoofCare for Donkeys');
        }
        // Wenn das Ziel 'HoofCare for Foals' erreicht wurde, wird die passende Rolle zugewiesen
        elseif ($finishGoal === 'specialty_instructor_hoofcare_for_foals') {
            $user->addRole('Instructor for HoofCare for Foals');
        }
        // Weitere Ziele können hier ebenfalls hinzugefügt werden
        elseif ($finishGoal === 'specialty_instructor_hoofcare_for_seniors') {
            $user->addRole('Instructor for HoofCare for Seniors');
        }

        // Hier können weitere Zielzuweisungen für weitere Kurse hinzugefügt werden
    }
}