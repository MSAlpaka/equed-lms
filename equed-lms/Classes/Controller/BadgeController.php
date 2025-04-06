<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Model\Badge;
use EquedLms\Domain\Repository\BadgeRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Exception\AccessDeniedException;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use Psr\Log\LoggerInterface;

class BadgeController extends ActionController
{
    protected BadgeRepository $badgeRepository;
    protected LoggerInterface $logger;

    public function __construct(
        BadgeRepository $badgeRepository,
        LoggerInterface $logger
    ) {
        $this->badgeRepository = $badgeRepository;
        $this->logger = $logger;
    }

    /**
     * Listet alle Badges auf.
     */
    public function listAction(): void
    {
        $this->ensureBackendAccess();

        $items = $this->badgeRepository->findAll();
        $this->view->assign('badges', $items);
    }

    /**
     * Zeigt ein einzelnes Badge.
     */
    public function showAction(Badge $badge): void
    {
        $this->ensureBackendAccess();

        $this->view->assign('badge', $badge);
    }

    /**
     * Erstellt ein neues Badge.
     */
    public function createAction(Badge $badge): void
    {
        $this->ensureBackendAccess();

        $this->badgeRepository->add($badge);
        $this->addFlashMessage('Badge wurde erfolgreich erstellt.', 'Erfolg', AbstractMessage::OK);
        $this->logger->info('Badge created', ['title' => $badge->getTitle()]);
        $this->redirect('list');
    }

    /**
     * Aktualisiert ein vorhandenes Badge.
     */
    public function updateAction(Badge $badge): void
    {
        $this->ensureBackendAccess();

        $this->badgeRepository->update($badge);
        $this->addFlashMessage('Badge wurde aktualisiert.', 'Erfolg', AbstractMessage::OK);
        $this->logger->info('Badge updated', ['id' => $badge->getUid()]);
        $this->redirect('list');
    }

    /**
     * Löscht ein Badge.
     */
    public function deleteAction(Badge $badge): void
    {
        $this->ensureBackendAccess();

        $this->badgeRepository->remove($badge);
        $this->addFlashMessage('Badge wurde gelöscht.', 'Hinweis', AbstractMessage::WARNING);
        $this->logger->warning('Badge deleted', ['id' => $badge->getUid()]);
        $this->redirect('list');
    }

    /**
     * Zugriff nur für Admins erlaubt.
     *
     * @throws AccessDeniedException
     */
    protected function ensureBackendAccess(): void
    {
        /** @var BackendUserAuthentication|null $backendUser */
        $backendUser = $GLOBALS['BE_USER'] ?? null;

        if (!$backendUser instanceof BackendUserAuthentication || !$backendUser->isAdmin()) {
            throw new AccessDeniedException('Access denied: Admin only');
        }
    }
}