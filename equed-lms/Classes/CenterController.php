<?php
namespace Equed\EquedLms\Controller\Backend;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Equed\EquedLms\Domain\Model\Center;
use Equed\EquedLms\Domain\Repository\CenterRepository;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;

/**
 * Controller für das Backend-Modul zur Verwaltung der Centers
 */
class CenterController extends ActionController
{
    /**
     * @var CenterRepository
     */
    protected $centerRepository;

    /**
     * @var PersistenceManager
     */
    protected $persistenceManager;

    public function injectCenterRepository(CenterRepository $centerRepository)
    {
        $this->centerRepository = $centerRepository;
    }

    public function injectPersistenceManager(PersistenceManager $persistenceManager)
    {
        $this->persistenceManager = $persistenceManager;
    }

    /**
     * Index-Aktion – Übersicht der Centers
     */
    public function indexAction()
    {
        $centers = $this->centerRepository->findAllCenters();
        $this->view->assign('centers', $centers);
    }

    /**
     * Aktion zum Erstellen eines neuen Centers
     */
    public function newAction()
    {
        // Neues Center erstellen
        $center = new Center();
        $this->view->assign('center', $center);
    }

    /**
     * Aktion zum Erstellen eines Centers in der DB
     */
    public function createAction(Center $center)
    {
        $this->centerRepository->add($center);
        $this->persistenceManager->persistAll();

        $this->addFlashMessage('Center wurde erfolgreich erstellt!');
        $this->redirect('index');
    }

    /**
     * Aktion zum Bearbeiten eines Centers
     */
    public function editAction(Center $center)
    {
        $this->view->assign('center', $center);
    }

    /**
     * Aktion zum Speichern der Änderungen an einem Center
     */
    public function updateAction(Center $center)
    {
        $this->centerRepository->update($center);
        $this->persistenceManager->persistAll();

        $this->addFlashMessage('Center wurde erfolgreich aktualisiert!');
        $this->redirect('index');
    }

    /**
     * Aktion zum Löschen eines Centers
     */
    public function deleteAction(Center $center)
    {
        $this->centerRepository->remove($center);
        $this->persistenceManager->persistAll();

        $this->addFlashMessage('Center wurde erfolgreich gelöscht!');
        $this->redirect('index');
    }
}