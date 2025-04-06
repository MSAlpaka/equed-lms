<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Model\Exam;
use EquedLms\Domain\Repository\ExamRepository;
use EquedLms\Domain\Repository\QuestionRepository;
use Psr\Log\LoggerInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Core\Exception\AccessDeniedException;

class ExamController extends ActionController
{
    public function __construct(
        protected readonly ExamRepository $examRepository,
        protected readonly QuestionRepository $questionRepository,
        protected readonly LoggerInterface $logger
    ) {}

    /**
     * Zeigt alle Prüfungen an.
     */
    public function listAction(): void
    {
        $this->checkAccess();

        $exams = $this->examRepository->findAll();
        $this->view->assign('exams', $exams);

        $this->logger->info('Alle Prüfungen angezeigt', ['count' => count($exams)]);
    }

    /**
     * Zeigt die Details einer Prüfung an.
     */
    public function showAction(Exam $exam): void
    {
        $this->checkAccess();

        $this->view->assign('exam', $exam);
        $this->view->assign('questions', $this->questionRepository->findByExam($exam));

        $this->logger->info('Prüfung angezeigt', ['examId' => $exam->getUid()]);
    }

    /**
     * Zeigt das Formular zur Erstellung einer neuen Prüfung.
     */
    public function newAction(): void
    {
        $this->checkAccess();

        $exam = new Exam();
        $this->view->assign('exam', $exam);

        $this->logger->info('Neues Prüfungsformular angezeigt');
    }

    /**
     * Erstellt eine neue Prüfung.
     */
    public function createAction(Exam $exam): void
    {
        $this->checkAccess();

        $this->examRepository->add($exam);
        $this->logger->info('Neue Prüfung erstellt', ['examId' => $exam->getUid()]);

        $this->addFlashMessage(
            LocalizationUtility::translate('flashMessages.examCreated', 'EquedLms') ?? 'Prüfung erfolgreich erstellt.',
            '',
            AbstractMessage::OK
        );

        $this->redirect('list');
    }

    /**
     * Zeigt das Bearbeitungsformular für eine bestehende Prüfung.
     */
    public function editAction(Exam $exam): void
    {
        $this->checkAccess();

        $this->view->assign('exam', $exam);
        $this->view->assign('questions', $this->questionRepository->findByExam($exam));

        $this->logger->info('Prüfung bearbeiten', ['examId' => $exam->getUid()]);
    }

    /**
     * Aktualisiert eine bestehende Prüfung.
     */
    public function updateAction(Exam $exam): void
    {
        $this->checkAccess();

        $this->examRepository->update($exam);
        $this->logger->info('Prüfung aktualisiert', ['examId' => $exam->getUid()]);

        $this->addFlashMessage(
            LocalizationUtility::translate('flashMessages.examUpdated', 'EquedLms') ?? 'Prüfung erfolgreich aktualisiert.',
            '',
            AbstractMessage::OK
        );

        $this->redirect('list');
    }

    /**
     * Löscht eine Prüfung.
     */
    public function deleteAction(Exam $exam): void
    {
        $this->checkAccess();

        $this->examRepository->remove($exam);
        $this->logger->info('Prüfung gelöscht', ['examId' => $exam->getUid()]);

        $this->addFlashMessage(
            LocalizationUtility::translate('flashMessages.examDeleted', 'EquedLms') ?? 'Prüfung erfolgreich gelöscht.',
            '',
            AbstractMessage::WARNING
        );

        $this->redirect('list');
    }

    /**
     * Überprüft den Zugriff: Nur Administratoren oder berechtigte Benutzer dürfen diese Funktionen ausführen.
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
}