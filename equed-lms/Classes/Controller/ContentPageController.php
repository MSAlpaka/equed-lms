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

class ContentPageController extends ActionController
{
    public function __construct(
        protected readonly ContentPageRepository $contentPageRepository,
        protected readonly LoggerInterface $logger
    ) {}

    /**
     * Zeigt eine Liste aller ContentPages.
     *
     * @throws AccessDeniedException
     */
    public function listAction(): void
    {
        $this->ensureAccess();
        $items = $this->contentPageRepository->findAll();
        $this->view->assign('contentPages', $items);
    }

    /**
     * Zeigt eine einzelne ContentPage.
     *
     * @throws AccessDeniedException
     */
    public function showAction(ContentPage $contentPage): void
    {
        $this->ensureAccess();
        $this->view->assign('contentPage', $contentPage);
    }

    /**
     * Erstellt eine neue ContentPage.
     *
     * @throws AccessDeniedException
     */
    public function createAction(ContentPage $contentPage): void
    {
        $this->ensureAccess();

        $this->contentPageRepository->add($contentPage);
        $this->addFlashMessage('Inhaltsseite erfolgreich erstellt.', '', AbstractMessage::OK);

        $this->logger->info('ContentPage created', [
            'title' => $contentPage->getTitle(),
        ]);

        $this->redirect('list');
    }

    /**
     * Aktualisiert eine bestehende ContentPage.
     *
     * @throws AccessDeniedException
     */
    public function updateAction(ContentPage $contentPage): void
    {
        $this->ensureAccess();

        $this->contentPageRepository->update($contentPage);
        $this->addFlashMessage('Inhaltsseite erfolgreich aktualisiert.', '', AbstractMessage::OK);

        $this->logger->info('ContentPage updated', [
            'id' => $contentPage->getUid(),
        ]);

        $this->redirect('list');
    }

    /**
     * Löscht eine ContentPage.
     *
     * @throws AccessDeniedException
     */
    public function deleteAction(ContentPage $contentPage): void
    {
        $this->ensureAccess();

        $this->contentPageRepository->remove($contentPage);
        $this->addFlashMessage('Inhaltsseite gelöscht.', '', AbstractMessage::WARNING);

        $this->logger->warning('ContentPage deleted', [
            'id' => $contentPage->getUid(),
        ]);

        $this->redirect('list');
    }

    /**
     * Zugriffsschutz: Nur eingeloggte Admins dürfen Änderungen vornehmen.
     *
     * @throws AccessDeniedException
     */
    protected function ensureAccess(): void
    {
        $user = $this->getFrontendUser();
        $groups = $user?->groupData['uid'] ?? [];

        if (!is_array($groups) || !in_array('ADMIN_GROUP_UID', $groups, true)) {
            throw new AccessDeniedException('Kein Zugriff auf Content-Seiten.');
        }
    }

    protected function getFrontendUser(): ?FrontendUserAuthentication
    {
        return $GLOBALS['TSFE']->fe_user ?? null;
    }
}