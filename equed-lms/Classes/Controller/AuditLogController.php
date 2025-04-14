<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Repository\AuditLogRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Exception\AccessDeniedException;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ResponseInterface;

class AuditLogController extends ActionController
{
    public function __construct(
        protected readonly AuditLogRepository $auditLogRepository,
        protected readonly LoggerInterface $logger
    ) {}

    /**
     * Lists all audit logs for a specific user.
     *
     * @throws AccessDeniedException
     */
    public function indexAction(int $userId): ResponseInterface
    {
        $this->ensureBackendAccess();

        $auditLogs = $this->auditLogRepository->findByUser($userId);

        if ($auditLogs->count() === 0) {
            $this->addFlashMessage(
                LocalizationUtility::translate('flashMessages.noAuditLogsForUser', 'EquedLms') ?? 'No audit logs found for the selected user.',
                '',
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

        return $this->htmlResponse();
    }

    /**
     * Shows audit logs filtered by action type.
     *
     * @throws AccessDeniedException
     */
    public function showAction(string $action): ResponseInterface
    {
        $this->ensureBackendAccess();

        $auditLogs = $this->auditLogRepository->findByAction($action);

        if ($auditLogs->count() === 0) {
            $this->addFlashMessage(
                LocalizationUtility::translate('flashMessages.noAuditLogsForAction', 'EquedLms')
                    ?? sprintf('No logs found for action "%s".', $action),
                '',
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

        return $this->htmlResponse();
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
            $this->logger->warning('Unauthorized backend access attempt.');
            throw new AccessDeniedException('Access denied: Admin only.');
        }
    }

    /**
     * Returns the backend user ID.
     */
    protected function getBackendUserId(): int
    {
        $context = GeneralUtility::makeInstance(Context::class);
        return (int)($context->getPropertyFromAspect('backend.user', 'id') ?? 0);
    }
}
