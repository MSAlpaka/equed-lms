<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Model\CourseProgram;
use EquedLms\Domain\Repository\CourseProgramRepository;
use Psr\Log\LoggerInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Core\Exception\AccessDeniedException;

class CourseProgramController extends ActionController
{
    public function __construct(
        protected readonly CourseProgramRepository $courseProgramRepository,
        protected readonly LoggerInterface $logger
    ) {}

    /**
     * Prüft den Zugriff: Nur Admins dürfen diese Funktionen ausführen.
     *
     * @throws AccessDeniedException
     */
    protected function checkAccess(): void
    {
        $user = $this->getAuthenticatedUser();
        if (!$user || !in_array('admin', $user->getRoles(), true)) {
            throw new AccessDeniedException('Zugriff verweigert: Nur Administratoren haben Zugriff auf diese Funktion.');
        }
    }

    /**
     * Gibt den aktuellen Frontend-User zurück.
     */
    protected function getAuthenticatedUser()
    {
        return $GLOBALS['TSFE']->fe_user->user ?? null;
    }

    /**
     * Zeigt alle Kursprogramme an.
     */
    public function listAction(): void
    {
        $this->checkAccess();

        $items = $this->courseProgramRepository->findAll();
        $this->view->assign('coursePrograms', $items);

        $this->logger->info('Alle Kursprogramme angezeigt', ['count' => count($items)]);
    }

    /**
     * Zeigt die Details eines Kursprogramms.
     */
    public function showAction(CourseProgram $courseProgram): void
    {
        $this->view->assign('courseProgram', $courseProgram);
        $this->logger->info('Kursprogramm angezeigt', ['id' => $courseProgram->getUid()]);
    }

    /**
     * Erstellt ein neues Kursprogramm.
     */
    public function createAction(CourseProgram $courseProgram): void
    {
        $this->checkAccess();

        $this->courseProgramRepository->add($courseProgram);
        $this->logger->info('Kursprogramm erstellt', ['id' => $courseProgram->getUid()]);

        $this->addFlashMessage(
            LocalizationUtility::translate('flashMessages.courseProgramCreated', 'EquedLms') ?? 'Kursprogramm erfolgreich erstellt.',
            '',
            AbstractMessage::OK
        );

        $this->redirect('list');
    }

    /**
     * Aktualisiert ein bestehendes Kursprogramm.
     */
    public function updateAction(CourseProgram $courseProgram): void
    {
        $this->checkAccess();

        $this->courseProgramRepository->update($courseProgram);
        $this->logger->info('Kursprogramm aktualisiert', ['id' => $courseProgram->getUid()]);

        $this->addFlashMessage(
            LocalizationUtility::translate('flashMessages.courseProgramUpdated', 'EquedLms') ?? 'Kursprogramm erfolgreich aktualisiert.',
            '',
            AbstractMessage::OK
        );

        $this->redirect('list');
    }

    /**
     * Löscht ein Kursprogramm.
     */
    public function deleteAction(CourseProgram $courseProgram): void
    {
        $this->checkAccess();

        $this->courseProgramRepository->remove($courseProgram);
        $this->logger->info('Kursprogramm gelöscht', ['id' => $courseProgram->getUid()]);

        $this->addFlashMessage(
            LocalizationUtility::translate('flashMessages.courseProgramDeleted', 'EquedLms') ?? 'Kursprogramm gelöscht.',
            '',
            AbstractMessage::WARNING
        );

        $this->redirect('list');
    }
}