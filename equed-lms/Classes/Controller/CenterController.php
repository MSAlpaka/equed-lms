<?php

declare(strict_types=1);

namespace EquedLms\Controller\Backend;

use EquedLms\Domain\Model\Center;
use EquedLms\Domain\Repository\CenterRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Exception\AccessDeniedException;
use Psr\Log\LoggerInterface;

class CenterController extends ActionController
{
    public function __construct(
        protected readonly CenterRepository $centerRepository,
        protected readonly PersistenceManager $persistenceManager,
        protected readonly LoggerInterface $logger
    ) {}

    /**
     * Prüft den Zugriff: Nur Admins dürfen diese Funktionen aufrufen.
     *
     * @throws AccessDeniedException
     */
    protected function checkAccess(): void
    {
        $backendUser = $this->getBackendUser();
        if (!$backendUser->isAdmin()) {
            throw new AccessDeniedException('Zugriff verweigert: Nur Administratoren haben Zugriff auf diese Funktion.');
        }
    }

    /**
     * Gibt den aktuellen Backend-User zurück.
     */
    protected function getBackendUser(): BackendUserAuthentication
    {
        return $GLOBALS['BE_USER'];
    }

    /**
     * Zeigt alle Ausbildungszentren an.
     */
    public function indexAction(): void
    {
        $this->checkAccess();

        $centers = $this->centerRepository->findAllCenters();
        $this->view->assign('centers', $centers);

        $this->logger->info('Alle Ausbildungszentren angezeigt', ['count' => count($centers)]);
    }

    /**
     * Zeigt das Formular zur Erstellung eines neuen Ausbildungszentrums.
     */
    public function newAction(): void
    {
        $this->checkAccess();

        $center = new Center();
        $this->view->assign('center', $center);
    }

    /**
     * Erstellt ein neues Ausbildungszentrum.
     */
    public function createAction(Center $center): void
    {
        $this->checkAccess();

        $this->centerRepository->add($center);
        $this->persistenceManager->persistAll();

        $this->addFlashMessage(
            LocalizationUtility::translate('msg.center_created', 'equed_lms') ?? 'Center erfolgreich erstellt.',
            '',
            \TYPO3\CMS\Core\Messaging\AbstractMessage::OK
        );

        $this->logger->info('Neues Ausbildungszentrum erstellt', ['id' => $center->getUid()]);

        $this->redirect('index');
    }

    /**
     * Zeigt das Bearbeitungsformular für ein bestehendes Ausbildungszentrum.
     */
    public function editAction(Center $center): void
    {
        $this->checkAccess();

        $this->view->assign('center', $center);
    }

    /**
     * Aktualisiert ein bestehendes Ausbildungszentrum.
     */
    public function updateAction(Center $center): void
    {
        $this->checkAccess();

        $this->centerRepository->update($center);
        $this->persistenceManager->persistAll();

        $this->addFlashMessage(
            LocalizationUtility::translate('msg.center_updated', 'equed_lms') ?? 'Center erfolgreich aktualisiert.',
            '',
            \TYPO3\CMS\Core\Messaging\AbstractMessage::OK
        );

        $this->logger->info('Ausbildungszentrum aktualisiert', ['id' => $center->getUid()]);

        $this->redirect('index');
    }

    /**
     * Löscht ein Ausbildungszentrum.
     */
    public function deleteAction(Center $center): void
    {
        $this->checkAccess();

        $this->centerRepository->remove($center);
        $this->persistenceManager->persistAll();

        $this->addFlashMessage(
            LocalizationUtility::translate('msg.center_deleted', 'equed_lms') ?? 'Center erfolgreich gelöscht.',
            '',
            \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING
        );

        $this->logger->info('Ausbildungszentrum gelöscht', ['id' => $center->getUid()]);

        $this->redirect('index');
    }
}