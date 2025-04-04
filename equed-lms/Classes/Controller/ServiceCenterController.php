<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Repository\IncidentRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Exception\AccessDeniedException;
use TYPO3\CMS\Core\Messaging\AbstractMessage;

class ServiceCenterController extends ActionController
{
    protected IncidentRepository $incidentRepository;

    public function __construct(IncidentRepository $incidentRepository)
    {
        $this->incidentRepository = $incidentRepository;
    }

    /**
     * Service Center Dashboard: Zeigt alle offenen Vorfälle an
     */
    public function indexAction(): void
    {
        $incidents = $this->incidentRepository->findAllOpenIncidents();
        $this->view->assign('incidents', $incidents);
    }

    /**
     * Bearbeitung von Vorfällen, die von Benutzern gemeldet wurden
     */
    public function handleIncidentAction(int $incidentId): void
    {
        $incident = $this->incidentRepository->findByUid($incidentId);

        if (!$incident) {
            $this->addFlashMessage(
                $this->translate('incident.notFound'),
                $this->translate('error'),
                AbstractMessage::ERROR
            );
            $this->redirect('index');
            return;
        }

        // Hier könnte eine Benutzerberechtigungsprüfung erfolgen, falls notwendig
        $this->checkPermissions($incident);

        $this->view->assign('incident', $incident);
    }

    /**
     * Berechtigungsprüfung für den Service Center Nutzer
     */
    protected function checkPermissions($incident): void
    {
        $user = $this->getCurrentUser();

        if (!$user || !$user->hasPermissionToEditIncident($incident)) {
            throw new AccessDeniedException($this->translate('accessDenied.incident'));
        }
    }

    /**
     * Holt den aktuellen eingeloggten Benutzer
     */
    protected function getCurrentUser(): ?\EquedLms\Domain\Model\FrontendUser
    {
        $userId = (int)($GLOBALS['TSFE']->fe_user->user['uid'] ?? 0);
        return $userId > 0 ? $this->userRepository->findByUid($userId) : null;
    }

    /**
     * Übersetzungs-Helper für die Sprachdateien
     */
    protected function translate(string $key, array $arguments = []): string
    {
        $languageService = $this->getLanguageService();
        $label = 'LLL:EXT:equed_lms/Resources/Private/Language/locallang.xlf:' . $key;
        return $languageService->sL($label) ?? $key;
    }

    /**
     * Holt den LanguageService für Übersetzungen
     */
    protected function getLanguageService()
    {
        return $GLOBALS['TSFE']->getLanguageService();
    }
}