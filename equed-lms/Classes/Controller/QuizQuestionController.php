<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Model\QuizQuestion;
use EquedLms\Domain\Repository\QuizQuestionRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ResponseInterface;

class QuizQuestionController extends ActionController
{
    public function __construct(
        protected readonly QuizQuestionRepository $quizQuestionRepository,
        protected readonly LoggerInterface $logger
    ) {}

    /**
     * Lists all quiz questions.
     */
    public function listAction(): ResponseInterface
    {
        $items = $this->quizQuestionRepository->findAll();
        $this->view->assign('quizQuestions', $items);

        $this->logger->info('Quiz questions listed', ['count' => count($items)]);
        return $this->htmlResponse();
    }

    /**
     * Displays a single quiz question.
     */
    public function showAction(QuizQuestion $quizQuestion): ResponseInterface
    {
        $this->view->assign('quizQuestion', $quizQuestion);
        $this->logger->info('Quiz question shown', ['id' => $quizQuestion->getUid()]);
        return $this->htmlResponse();
    }

    /**
     * Creates a new quiz question.
     */
    public function createAction(QuizQuestion $quizQuestion): ResponseInterface
    {
        $this->quizQuestionRepository->add($quizQuestion);

        $this->addFlashMessage(
            LocalizationUtility::translate('quiz.question.created', 'equed_lms') ?? 'Question created.',
            '',
            AbstractMessage::OK
        );
        $this->logger->info('Quiz question created', ['questionText' => $quizQuestion->getQuestionText()]);
        return $this->redirect('list');
    }

    /**
     * Updates an existing quiz question.
     */
    public function updateAction(QuizQuestion $quizQuestion): ResponseInterface
    {
        $this->quizQuestionRepository->update($quizQuestion);

        $this->addFlashMessage(
            LocalizationUtility::translate('quiz.question.updated', 'equed_lms') ?? 'Question updated.',
            '',
            AbstractMessage::OK
        );
        $this->logger->info('Quiz question updated', ['id' => $quizQuestion->getUid()]);
        return $this->redirect('list');
    }

    /**
     * Deletes a quiz question.
     */
    public function deleteAction(QuizQuestion $quizQuestion): ResponseInterface
    {
        $this->quizQuestionRepository->remove($quizQuestion);

        $this->addFlashMessage(
            LocalizationUtility::translate('quiz.question.deleted', 'equed_lms') ?? 'Question deleted.',
            '',
            AbstractMessage::WARNING
        );
        $this->logger->warning('Quiz question deleted', ['id' => $quizQuestion->getUid()]);
        return $this->redirect('list');
    }
}
