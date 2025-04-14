<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Model\Incident;
use EquedLms\Domain\Model\FrontendUser;
use EquedLms\Domain\Repository\IncidentRepository;
use EquedLms\Domain\Repository\FrontendUserRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Exception\AccessDeniedException;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ResponseInterface;

class ServiceCenterController extends ActionController
{
    public function __construct(
        protected readonly IncidentRepository $incidentRepository,
        protected readonly FrontendUserRepository $userRepository,
        protected readonly LoggerInterface $logger
    ) {}

    /**
     * Service Center Dashboard: shows all open incidents.
     */
    public function indexAction(): ResponseInterface
    {
        $incidents = $this->incidentRepository->findAllOpenIncidents();
        $this->view->assign('incidents', $incidents);

        $this->logger->info('Service center loaded incidents', ['count' => count($incidents)]);
        return $this->htmlResponse();
    }

    /**
     * Handles the selected incident.
     *
     * @throws AccessDeniedException
     */
    public function handleIncidentAction(int $incidentId): ResponseInterface
    {
        $incident = $this->incidentRepository->findByUid($incidentId);

        if (!$incident) {
            $this->addFlashMessage(
                LocalizationUtility::translate('incident.notFound', 'equed_lms') ?? 'Incident not found.',
                '',
                AbstractMessage::ERROR
            );
            $this->logger->warning('Incident not found', ['incidentId' => $incidentId]);
            return $this->redirect('index');
        }

        $this->checkPermissions($incident);

        $this->view->assign('incident', $incident);
        return $this->htmlResponse();
    }

    /**
     * Checks if the current user may edit the given incident.
     *
     * @throws AccessDeniedException
     */
    protected function checkPermissions(Incident $incident): void
    {
        $user = $this->getCurrentUser();

        if (!$user || !$user->hasPermissionToEditIncident($incident)) {
            $this->logger->warning('Access denied on incident edit.', [
                'userId' => $user?->getUid(),
                'incidentId' => $incident->getUid()
            ]);
            throw new AccessDeniedException(
                LocalizationUtility::translate('accessDenied.incident', 'equed_lms') ?? 'Access denied.'
            );
        }
    }

    /**
     * Returns the currently logged in frontend user object.
     */
    protected function getCurrentUser(): ?FrontendUser
    {
        $context = GeneralUtility::makeInstance(Context::class);
        $userId = (int)($context->getPropertyFromAspect('frontend.user', 'id') ?? 0);
        return $userId > 0 ? $this->userRepository->findByUid($userId) : null;
    }
}
