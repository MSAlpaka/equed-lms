<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Repository\AuditLogRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Exception\AccessDeniedException;
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
     * @throws AccessDeniedException
     */
    public function indexAction(int $userId): void
    {
        $this->ensureBackendAccess();

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
            'accessedBy' => $this->getBackendUserId(),
            'timestamp' => time(),
        ]);

        $this->view->assignMultiple([
            'auditLogs' => $auditLogs,
            'userId' => $userId,
        ]);
    }

    /**
     * Shows audit log details filtered by action type.
     *
     * @throws AccessDeniedException
     */
    public function showAction(string $action): void
    {
        $this->ensureBackendAccess();

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
            'accessedBy' => $this->getBackendUserId(),
            'timestamp' => time(),
        ]);

        $this->view->assignMultiple([
            'auditLogs' => $auditLogs,
            'action' => $action,
        ]);
    }

    /**
     * Checks backend access and throws AccessDeniedException if unauthorized.
     *
     * @throws AccessDeniedException
     */
    protected function ensureBackendAccess(): void
    {
        $context = GeneralUtility::makeInstance(Context::class);
        $isAdmin = $context->getPropertyFromAspect('backend.user', 'isAdmin');
        if (!$isAdmin) {
            throw new AccessDeniedException('Access denied: Admin only');
        }
    }

    /**
     * Returns the current backend user's ID, if available.
     */
    protected function getBackendUserId(): ?int
    {
        return isset($GLOBALS['BE_USER']->user['uid']) ? (int)$GLOBALS['BE_USER']->user['uid'] : null;
    }
}