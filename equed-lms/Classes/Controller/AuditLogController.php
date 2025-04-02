<?php

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Equed\EquedLms\Domain\Repository\AuditLogRepository;

class AuditLogController extends ActionController
{
    /**
     * @var \Equed\EquedLms\Domain\Repository\AuditLogRepository
     */
    protected AuditLogRepository $auditLogRepository;

    public function __construct(AuditLogRepository $auditLogRepository)
    {
        $this->auditLogRepository = $auditLogRepository;
    }

    /**
     * List all logs for a specific user
     */
    public function indexAction(int $userId): void
    {
        $auditLogs = $this->auditLogRepository->findByUser($userId);
        $this->view->assign('auditLogs', $auditLogs);
    }

    /**
     * Show log details by action type
     */
    public function showAction(string $action): void
    {
        $auditLogs = $this->auditLogRepository->findByAction($action);
        $this->view->assign('auditLogs', $auditLogs);
    }
}