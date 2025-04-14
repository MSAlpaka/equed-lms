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
use Psr\Http\Message\ResponseInterface;

class QuestionController extends ActionController
{
    public function __construct(
        protected readonly QuizQuestionRepository $quizQuestionRepository,
        protected readonly QuizAnswerRepository $quizAnswerRepository,
        protected readonly LoggerInterface $logger
    ) {}

    /**
     * Lists all questions.
     */
    public function listAction(): ResponseInterface
    {
        $questions = $this->quizQuestionRepository->findAll();
        $this->view->assign('questions', $questions);

        $this->logger->info('Question list rendered', ['count' => count($questions)]);
        return $this->htmlResponse();
    }

    /**
     * Creates a new quiz question with answers.
     */
    public function createAction(): ResponseInterface
    {
        $question = new QuizQuestion();
        $question->setQuestionText($this->request->getArgument('questionText'));

        $answer1 = new QuizAnswer();
        $answer1->setAnswerText($this->request->getArgument('answer1Text'));
        $answer1->setIsCorrect(true);

        $answer2 = new QuizAnswer();
        $answer2->setAnswerText($this->request->getArgument('answer2Text'));
        $answer2->setIsCorrect(false);

        $question->addAnswer($answer1);
        $question->addAnswer($answer2);

        $this->quizQuestionRepository->add($question);

        $this->addFlashMessage(
            LocalizationUtility::translate('flashMessages.questionCreated', 'EquedLms') ?? 'Question successfully created.',
            '',
            AbstractMessage::OK
        );

        $this->logger->info('Quiz question created', ['text' => $question->getQuestionText()]);
        return $this->redirect('list');
    }

    /**
     * Edits an existing quiz question.
     */
    public function editAction(QuizQuestion $question): ResponseInterface
    {
        $this->view->assign('question', $question);
        $this->view->assign('answers', $this->quizAnswerRepository->findByQuestion($question));

        return $this->htmlResponse();
    }

    /**
     * Updates an existing quiz question.
     */
    public function updateAction(QuizQuestion $question): ResponseInterface
    {
        $this->quizQuestionRepository->update($question);

        $this->addFlashMessage(
            LocalizationUtility::translate('flashMessages.questionUpdated', 'EquedLms') ?? 'Question successfully updated.',
            '',
            AbstractMessage::OK
        );

        $this->logger->info('Quiz question updated', ['questionId' => $question->getUid()]);
        return $this->redirect('list');
    }

    /**
     * Deletes a quiz question.
     */
    public function deleteAction(QuizQuestion $question): ResponseInterface
    {
        $this->quizQuestionRepository->remove($question);

        $this->addFlashMessage(
            LocalizationUtility::translate('flashMessages.questionDeleted', 'EquedLms') ?? 'Question deleted.',
            '',
            AbstractMessage::WARNING
        );

        $this->logger->warning('Quiz question deleted', ['questionId' => $question->getUid()]);
        return $this->redirect('list');
    }
}
