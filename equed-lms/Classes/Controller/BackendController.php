<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Exception\AccessDeniedException;
use EquedLms\Domain\Repository\CourseInstanceRepository;
use EquedLms\Domain\Repository\FrontendUserRepository;

class BackendController extends ActionController
{
    protected CourseInstanceRepository $courseInstanceRepository;
    protected FrontendUserRepository $frontendUserRepository;

    public function __construct(
        CourseInstanceRepository $courseInstanceRepository,
        FrontendUserRepository $frontendUserRepository
    ) {
        parent::__construct();
        $this->courseInstanceRepository = $courseInstanceRepository;
        $this->frontendUserRepository = $frontendUserRepository;
    }

    /**
     * Admin-Dashboard: Übersicht über Kurse, Nutzende etc.
     */
    public function indexAction(): void
    {
        $this->checkAccess();

        $dashboardData = [
            'courseCount' => $this->courseInstanceRepository->countAll(),
            'activeUserCount' => $this->frontendUserRepository->countActiveUsers(),
            'completedCourses' => $this->courseInstanceRepository->countCompletedCourses(),
            // Weitere Metriken wie ausstehende Prüfungen könnten hier eingebaut werden
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
                'pendingValidations' => [], // Hier können noch dynamische Daten hinzugefügt werden
                'openReports' => [],
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

        // Dynamische Adminprüfung statt harter Kodierung einer UID
        if (!$backendUser instanceof BackendUserAuthentication || !$backendUser->isAdmin()) {
            throw new AccessDeniedException('Access denied: Only the main admin may access this section.', 1670000051);
        }
    }
}