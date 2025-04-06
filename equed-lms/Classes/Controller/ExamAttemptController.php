<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Model\ExamAttempt;
use EquedLms\Domain\Repository\ExamAttemptRepository;
use Psr\Log\LoggerInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Exception\AccessDeniedException;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

class ExamAttemptController extends ActionController
{
    public function __construct(
        protected readonly ExamAttemptRepository $examAttemptRepository,
        protected readonly LoggerInterface $logger
    ) {}

    /**
     * Zeigt eine Liste aller Prüfungsversuche.
     */
    public function listAction(): void
    {
        $examAttempts = $this->examAttemptRepository->findAll();
        $this->view->assign('examAttempts', $examAttempts);

        $this->logger->info('Prüfungsversuche angezeigt', ['count' => count($examAttempts)]);
    }

    /**
     * Zeigt Details zu einem Prüfungsversuch.
     */
    public function showAction(ExamAttempt $examAttempt): void
    {
        $this->view->assign('examAttempt', $examAttempt);

        $this->logger->info('Prüfungsversuch angezeigt', ['id' => $examAttempt->getUid()]);
    }

    /**
     * Erstellt einen neuen Prüfungsversuch.
     */
    public function createAction(ExamAttempt $examAttempt): void
    {
        $this->checkAccess();

        $this->examAttemptRepository->add($examAttempt);
        $this->logger->info('Prüfungsversuch erstellt', ['id' => $examAttempt->getUid()]);

        $this->addFlashMessage(
            LocalizationUtility::translate('flashMessages.examAttemptCreated', 'EquedLms') ?? 'Prüfungsversuch erfolgreich erstellt.',
            '',
            AbstractMessage::OK
        );

        $this->redirect('list');
    }

    /**
     * Aktualisiert einen bestehenden Prüfungsversuch.
     */
    public function updateAction(ExamAttempt $examAttempt): void
    {
        $this->checkAccess();

        $this->examAttemptRepository->update($examAttempt);
        $this->logger->info('Prüfungsversuch aktualisiert', ['id' => $examAttempt->getUid()]);

        $this->addFlashMessage(
            LocalizationUtility::translate('flashMessages.examAttemptUpdated', 'EquedLms') ?? 'Prüfungsversuch erfolgreich aktualisiert.',
            '',
            AbstractMessage::OK
        );

        $this->redirect('list');
    }

    /**
     * Löscht einen Prüfungsversuch.
     */
    public function deleteAction(ExamAttempt $examAttempt): void
    {
        $this->checkAccess();

        $this->examAttemptRepository->remove($examAttempt);
        $this->logger->info('Prüfungsversuch gelöscht', ['id' => $examAttempt->getUid()]);

        $this->addFlashMessage(
            LocalizationUtility::translate('flashMessages.examAttemptDeleted', 'EquedLms') ?? 'Prüfungsversuch gelöscht.',
            '',
            AbstractMessage::WARNING
        );

        $this->redirect('list');
    }

    /**
     * Zugriffsschutz: Nur Admins dürfen Prüfungsversuche erstellen und bearbeiten.
     *
     * @throws AccessDeniedException
     */
    protected function checkAccess(): void
    {
        $user = $this->getFrontendUser();
        if (!$user || !$user->getGroups()->contains(1)) {  // 1 ist die ID der Admin-Gruppe
            throw new AccessDeniedException('Zugriff verweigert: Nur Administratoren haben Zugriff auf diese Funktion.');
        }
    }

    /**
     * Gibt den aktuellen Frontend-User zurück.
     */
    protected function getFrontendUser(): ?\TYPO3\CMS\Extbase\Domain\Model\FrontendUser
    {
        return $GLOBALS['TSFE']->fe_user->user;
    }
}