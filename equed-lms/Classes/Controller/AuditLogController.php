<?php

declare(strict_types=1);

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Equed\EquedLms\Domain\Repository\AuditLogRepository;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use Psr\Log\LoggerInterface;

class AuditLogController extends ActionController
{
    protected AuditLogRepository $auditLogRepository;
    protected LoggerInterface $logger;

    public function __construct(
        AuditLogRepository $auditLogRepository,
        LoggerInterface $logger
    ) {
        $this->auditLogRepository = $auditLogRepository;
        $this->logger = $logger;
    }

    /**
     * Lists all audit logs for a specific user.
     *
     * @param int $userId The user's unique identifier.
     */
    public function indexAction(int $userId): void
    {
        $auditLogs = $this->auditLogRepository->findByUser($userId);

        if ($auditLogs->count() === 0) {
            $this->addFlashMessage(
                'No audit logs found for the selected user.',
                'Notice',
                AbstractMessage::NOTICE
            );
        }

        $this->logger->info('Audit logs accessed for user', [
            'userId' => $userId,
            'accessedBy' => $this->getBackendUserId()
        ]);

        $this->view->assignMultiple([
            'auditLogs' => $auditLogs,
            'userId' => $userId
        ]);
    }

    /**
     * Shows audit log details filtered by action type.
     *
     * @param string $action The action type to filter logs.
     */
    public function showAction(string $action): void
    {
        $auditLogs = $this->auditLogRepository->findByAction($action);

        if ($auditLogs->count() === 0) {
            $this->addFlashMessage(
                sprintf('No logs found for action "%s".', htmlspecialchars($action)),
                'Notice',
                AbstractMessage::NOTICE
            );
        }

        $this->logger->info('Audit logs viewed by action', [
            'action' => $action,
            'accessedBy' => $this->getBackendUserId()
        ]);

        $this->view->assignMultiple([
            'auditLogs' => $auditLogs,
            'action' => $action
        ]);
    }

    /**
     * Returns the current backend user's ID, if available.
     *
     * @return int|null
     */
    protected function getBackendUserId(): ?int
    {
        return isset($GLOBALS['BE_USER']->user['uid']) ? (int)$GLOBALS['BE_USER']->user['uid'] : null;
    }
}