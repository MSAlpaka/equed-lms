<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Model\QuizQuestion;
use EquedLms\Domain\Model\QuizAnswer;
use EquedLms\Domain\Repository\QuizQuestionRepository;
use EquedLms\Domain\Repository\QuizAnswerRepository;
use Psr\Log\LoggerInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

class QuestionController extends ActionController
{
    public function __construct(
        protected readonly QuizQuestionRepository $quizQuestionRepository,
        protected readonly QuizAnswerRepository $quizAnswerRepository,
        protected readonly LoggerInterface $logger
    ) {}

    /**
     * Erstellt eine neue Prüfungsfrage mit möglichen Antwortmöglichkeiten.
     */
    public function createAction(): void
    {
        // Frage erstellen
        $question = new QuizQuestion();
        $question->setQuestionText($this->request->getArgument('questionText'));

        // Antworten hinzufügen
        $answer1 = new QuizAnswer();
        $answer1->setAnswerText($this->request->getArgument('answer1Text'));
        $answer1->setIsCorrect(true); // Beispiel für die richtige Antwort

        $answer2 = new QuizAnswer();
        $answer2->setAnswerText($this->request->getArgument('answer2Text'));
        $answer2->setIsCorrect(false);

        $question->addAnswer($answer1);
        $question->addAnswer($answer2);

        $this->quizQuestionRepository->add($question);

        $this->addFlashMessage(
            LocalizationUtility::translate('flashMessages.questionCreated', 'EquedLms') ?? 'Frage erfolgreich erstellt.',
            '',
            AbstractMessage::OK
        );

        $this->logger->info('Neue Prüfungsfrage erstellt', ['questionText' => $question->getQuestionText()]);

        $this->redirect('list');
    }

    /**
     * Bearbeitet eine bestehende Prüfungsfrage und deren Antworten.
     */
    public function editAction(QuizQuestion $question): void
    {
        $this->view->assign('question', $question);
        $this->view->assign('answers', $this->quizAnswerRepository->findByQuestion($question));
    }

    /**
     * Speichert die Änderungen an einer bestehenden Prüfungsfrage.
     */
    public function updateAction(QuizQuestion $question): void
    {
        $this->quizQuestionRepository->update($question);

        $this->addFlashMessage(
            LocalizationUtility::translate('flashMessages.questionUpdated', 'EquedLms') ?? 'Frage erfolgreich aktualisiert.',
            '',
            AbstractMessage::OK
        );

        $this->logger->info('Prüfungsfrage aktualisiert', ['questionId' => $question->getUid()]);

        $this->redirect('list');
    }

    /**
     * Löscht eine Prüfungsfrage.
     */
    public function deleteAction(QuizQuestion $question): void
    {
        $this->quizQuestionRepository->remove($question);

        $this->addFlashMessage(
            LocalizationUtility::translate('flashMessages.questionDeleted', 'EquedLms') ?? 'Frage erfolgreich gelöscht.',
            '',
            AbstractMessage::WARNING
        );

        $this->logger->info('Prüfungsfrage gelöscht', ['questionId' => $question->getUid()]);

        $this->redirect('list');
    }

    /**
     * Zeigt alle Fragen eines bestimmten Tests oder Quizzes an.
     */
    public function listAction(int $quizId): void
    {
        $questions = $this->quizQuestionRepository->findByQuiz($quizId);
        $this->view->assign('questions', $questions);
    }
}