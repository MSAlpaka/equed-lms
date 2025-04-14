<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Model\Badge;
use EquedLms\Domain\Repository\BadgeRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Exception\AccessDeniedException;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ResponseInterface;

class BadgeController extends ActionController
{
    public function __construct(
        protected readonly BadgeRepository $badgeRepository,
        protected readonly LoggerInterface $logger
    ) {}

    /**
     * Lists all badges.
     */
    public function listAction(): ResponseInterface
    {
        $this->ensureBackendAccess();

        $badges = $this->badgeRepository->findAll();
        $this->view->assign('badges', $badges);

        $this->logger->info('Badge list displayed', ['count' => count($badges)]);
        return $this->htmlResponse();
    }

    /**
     * Displays a single badge.
     */
    public function showAction(Badge $badge): ResponseInterface
    {
        $this->ensureBackendAccess();

        $this->view->assign('badge', $badge);
        $this->logger->info('Badge details shown', ['id' => $badge->getUid()]);
        return $this->htmlResponse();
    }

    /**
     * Creates a new badge.
     */
    public function createAction(Badge $badge): ResponseInterface
    {
        $this->ensureBackendAccess();

        $this->badgeRepository->add($badge);
        $this->addFlashMessage(
            LocalizationUtility::translate('flashMessages.badgeCreated', 'EquedLms') ?? 'Badge successfully created.',
            '',
            AbstractMessage::OK
        );
        $this->logger->info('Badge created', ['title' => $badge->getTitle()]);
        return $this->redirect('list');
    }

    /**
     * Updates an existing badge.
     */
    public function updateAction(Badge $badge): ResponseInterface
    {
        $this->ensureBackendAccess();

        $this->badgeRepository->update($badge);
        $this->addFlashMessage(
            LocalizationUtility::translate('flashMessages.badgeUpdated', 'EquedLms') ?? 'Badge successfully updated.',
            '',
            AbstractMessage::OK
        );
        $this->logger->info('Badge updated', ['id' => $badge->getUid()]);
        return $this->redirect('list');
    }

    /**
     * Deletes a badge.
     */
    public function deleteAction(Badge $badge): ResponseInterface
    {
        $this->ensureBackendAccess();

        $this->badgeRepository->remove($badge);
        $this->addFlashMessage(
            LocalizationUtility::translate('flashMessages.badgeDeleted', 'EquedLms') ?? 'Badge deleted.',
            '',
            AbstractMessage::WARNING
        );
        $this->logger->warning('Badge deleted', ['id' => $badge->getUid()]);
        return $this->redirect('list');
    }

    /**
     * Ensures access for backend admin users only.
     *
     * @throws AccessDeniedException
     */
    protected function ensureBackendAccess(): void
    {
        /** @var BackendUserAuthentication|null $backendUser */
        $backendUser = $GLOBALS['BE_USER'] ?? null;

        if (!$backendUser instanceof BackendUserAuthentication || !$backendUser->isAdmin()) {
            $this->logger->warning('Backend access denied (badge section)');
            throw new AccessDeniedException('Access denied: Only admin may access this section.', 167000101);
        }
    }
}
