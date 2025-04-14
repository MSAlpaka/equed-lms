<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Model\ContentPage;
use EquedLms\Domain\Repository\ContentPageRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Authentication\FrontendUserAuthentication;
use TYPO3\CMS\Core\Exception\AccessDeniedException;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ResponseInterface;

class ContentPageController extends ActionController
{
    public function __construct(
        protected readonly ContentPageRepository $contentPageRepository,
        protected readonly LoggerInterface $logger
    ) {}

    /**
     * Displays a list of all content pages.
     */
    public function listAction(): ResponseInterface
    {
        $this->ensureAccess();

        $items = $this->contentPageRepository->findAll();
        $this->view->assign('contentPages', $items);

        return $this->htmlResponse();
    }

    /**
     * Displays a single content page.
     */
    public function showAction(ContentPage $contentPage): ResponseInterface
    {
        $this->ensureAccess();
        $this->view->assign('contentPage', $contentPage);
        return $this->htmlResponse();
    }

    /**
     * Creates a new content page.
     */
    public function createAction(ContentPage $contentPage): ResponseInterface
    {
        $this->ensureAccess();

        $this->contentPageRepository->add($contentPage);
        $this->addFlashMessage(
            LocalizationUtility::translate('contentPage.created', 'equed_lms') ?? 'Content page created successfully.',
            '',
            AbstractMessage::OK
        );

        $this->logger->info('ContentPage created', ['title' => $contentPage->getTitle()]);
        return $this->redirect('list');
    }

    /**
     * Updates an existing content page.
     */
    public function updateAction(ContentPage $contentPage): ResponseInterface
    {
        $this->ensureAccess();

        $this->contentPageRepository->update($contentPage);
        $this->addFlashMessage(
            LocalizationUtility::translate('contentPage.updated', 'equed_lms') ?? 'Content page updated successfully.',
            '',
            AbstractMessage::OK
        );

        $this->logger->info('ContentPage updated', ['id' => $contentPage->getUid()]);
        return $this->redirect('list');
    }

    /**
     * Deletes a content page.
     */
    public function deleteAction(ContentPage $contentPage): ResponseInterface
    {
        $this->ensureAccess();

        $this->contentPageRepository->remove($contentPage);
        $this->addFlashMessage(
            LocalizationUtility::translate('contentPage.deleted', 'equed_lms') ?? 'Content page deleted.',
            '',
            AbstractMessage::WARNING
        );

        $this->logger->warning('ContentPage deleted', ['id' => $contentPage->getUid()]);
        return $this->redirect('list');
    }

    /**
     * Only allow access for specific FE groups or roles.
     */
    protected function ensureAccess(): void
    {
        $user = $GLOBALS['TSFE']->fe_user ?? null;
        $groupIds = $user?->groupData['uid'] ?? [];

        if (!is_array($groupIds) || !in_array(123, $groupIds, true)) {
            $this->logger->warning('Access denied in ContentPageController');
            throw new AccessDeniedException('Access denied.');
        }
    }
}
