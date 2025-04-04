<?php

declare(strict_types=1);

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Exception\AccessDeniedException;
use Equed\EquedLms\Domain\Repository\CourseRepository;
use Equed\EquedLms\Domain\Repository\UserCourseRecordRepository;

class BackendController extends ActionController
{
    protected CourseRepository $courseRepository;
    protected UserCourseRecordRepository $userCourseRecordRepository;

    public function __construct(
        CourseRepository $courseRepository,
        UserCourseRecordRepository $userCourseRecordRepository
    ) {
        parent::__construct();
        $this->courseRepository = $courseRepository;
        $this->userCourseRecordRepository = $userCourseRecordRepository;
    }

    /**
     * Admin-Dashboard: Übersicht über Kurse, Nutzende etc.
     */
    public function indexAction(): void
    {
        $this->checkAccess();

        $dashboardData = [
            'courseCount' => $this->courseRepository->countAll(),
            'activeUserCount' => $this->userCourseRecordRepository->countActiveUsers(),
            'completedCourses' => $this->userCourseRecordRepository->countCompletedCourses(),
            // TODO: Weitere sinnvolle Metriken einbinden
        ];

        $this->view->assignMultiple([
            'dashboardData' => $dashboardData,
        ]);
    }

    /**
     * Verwaltungsansicht: Platzhalter für spätere Adminfunktionen
     */
    public function manageAction(): void
    {
        $this->checkAccess();

        $this->view->assignMultiple([
            'managementData' => [
                'pendingValidations' => [],
                'openReports' => [],
                // TODO: Anbindung an Zertifizierungsprozesse, QMS etc.
            ]
        ]);
    }

    /**
     * Zugriffsschutz: Nur Haupt-Admin darf auf Backend-Module zugreifen
     */
    protected function checkAccess(): void
    {
        /** @var BackendUserAuthentication|null $backendUser */
        $backendUser = $GLOBALS['BE_USER'] ?? null;

        $allowedAdminUid = 1; // Setze hier deine eigene BE-User-ID, falls abweichend

        if (
            !$backendUser instanceof BackendUserAuthentication ||
            (!$backendUser->isAdmin() && (int)$backendUser->user['uid'] !== $allowedAdminUid)
        ) {
            throw new AccessDeniedException('Access denied: Only the main admin may access this section.', 1670000051);
        }
    }
}