<?php
declare(strict_types=1);

namespace Equed\EquedLms\Controller;

use Equed\EquedLms\Domain\Repository\IncidentRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Messaging\AbstractMessage;

class ServiceCenterController extends ActionController
{
    protected IncidentRepository $incidentRepository;

    public function __construct(IncidentRepository $incidentRepository)
    {
        $this->incidentRepository = $incidentRepository;
    }

    /**
     * Service center dashboard
     */
    public function indexAction(): void
    {
        $incidents = $this->incidentRepository->findAllOpenIncidents();
        $this->view->assign('incidents', $incidents);
    }

    /**
     * Handle incidents reported by users
     */
    public function handleIncidentAction(int $incidentId): void
    {
        $incident = $this->incidentRepository->findByUid($incidentId);

        if (!$incident) {
            $this->addFlashMessage('Incident not found.', 'Error', AbstractMessage::ERROR);
            $this->redirect('index');
            return;
        }

        $this->view->assign('incident', $incident);
    }
}