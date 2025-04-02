<?php

declare(strict_types=1);

namespace Equed\EquedLms\Controller;

use Equed\EquedLms\Service\CourseValidationService;
use Equed\EquedLms\Service\InstructorMatchingService;
use Equed\EquedLms\Domain\Model\UserCourseRecord;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class CourseBookingController extends ActionController
{
    /**
     * @var CourseValidationService
     */
    protected $courseValidationService;

    /**
     * @var InstructorMatchingService
     */
    protected $instructorMatchingService;

    public function __construct(CourseValidationService $courseValidationService, InstructorMatchingService $instructorMatchingService)
    {
        $this->courseValidationService = $courseValidationService;
        $this->instructorMatchingService = $instructorMatchingService;
    }

    /**
     * Bucht einen Kurs und prüft, ob die Voraussetzungen erfüllt sind
     *
     * @param UserCourseRecord $userCourseRecord
     * @return void
     */
    public function bookCourseAction(UserCourseRecord $userCourseRecord)
    {
        // Überprüfen, ob der Benutzer die Voraussetzungen für den Kurs erfüllt
        if (!$this->courseValidationService->checkPrerequisites($userCourseRecord)) {
            // Wenn die Voraussetzungen nicht erfüllt sind, zeige eine Fehlermeldung
            $this->addFlashMessage(
                $this->translate('error.insufficient_prerequisites'), 
                'Voraussetzungen nicht erfüllt',
                \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR
            );
            return;
        }

        // Weisen Sie dem Benutzer die Instructor-Rolle basierend auf dem Kursziel zu
        $this->instructorMatchingService->assignInstructorRole($userCourseRecord);

        // Wenn alle Voraussetzungen erfüllt sind, wird der Kurs gebucht
        $this->courseRepository->add($userCourseRecord);
        $this->addFlashMessage(
            $this->translate('success.course_booked'), 
            'Erfolg', 
            \TYPO3\CMS\Core\Messaging\AbstractMessage::OK
        );
        $this->redirect('showCourseDetails');
    }
}