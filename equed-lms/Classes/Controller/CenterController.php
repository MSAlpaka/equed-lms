<?php

declare(strict_types=1);

namespace Equed\EquedLms\Controller\Backend;

use Equed\EquedLms\Domain\Model\Center;
use Equed\EquedLms\Domain\Repository\CenterRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Backend Controller zur Verwaltung der Ausbildungszentren
 */
class CenterController extends ActionController
{
    public function __construct(
        protected readonly CenterRepository $centerRepository,
        protected readonly PersistenceManager $persistenceManager
    ) {}

    protected function checkAccess(): void
    {
        $backendUser = $this->getBackendUser();
        if (!$backendUser->isAdmin()) {
            throw new \RuntimeException('Zugriff verweigert.', 1663428221);
        }
    }

    protected function getBackendUser(): BackendUserAuthentication
    {
        return $GLOBALS['BE_USER'];
    }

    public function indexAction(): void
    {
        $this->checkAccess();

        $centers = $this->centerRepository->findAllCenters();
        $this->view->assign('centers', $centers);
    }

    public function newAction(): void
    {
        $this->checkAccess();

        $center = new Center();
        $this->view->assign('center', $center);
    }

    public function createAction(Center $center): void
    {
        $this->checkAccess();

        $this->centerRepository->add($center);
        $this->persistenceManager->persistAll();

        $this->addFlashMessage(
            LocalizationUtility::translate('msg.center_created', 'equed_lms') ?? 'Center erfolgreich erstellt.'
        );
        $this->redirect('index');
    }

    public function editAction(Center $center): void
    {
        $this->checkAccess();
        $this->view->assign('center', $center);
    }

    public function updateAction(Center $center): void
    {
        $this->checkAccess();

        $this->centerRepository->update($center);
        $this->persistenceManager->persistAll();

        $this->addFlashMessage(
            LocalizationUtility::translate('msg.center_updated', 'equed_lms') ?? 'Center erfolgreich aktualisiert.'
        );
        $this->redirect('index');
    }

    public function deleteAction(Center $center): void
    {
        $this->checkAccess();

        $this->centerRepository->remove($center);
        $this->persistenceManager->persistAll();

        $this->addFlashMessage(
            LocalizationUtility::translate('msg.center_deleted', 'equed_lms') ?? 'Center erfolgreich gelöscht.'
        );
        $this->redirect('index');
    }
}