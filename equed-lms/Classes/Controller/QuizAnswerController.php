<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Model\QuizAnswer;
use EquedLms\Domain\Repository\QuizAnswerRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ResponseInterface;

class QuizAnswerController extends ActionController
{
    public function __construct(
        protected readonly QuizAnswerRepository $quizAnswerRepository,
        protected readonly LoggerInterface $logger
    ) {}

    /**
     * Lists all quiz answers.
     */
    public function listAction(): ResponseInterface
    {
        $items = $this->quizAnswerRepository->findAll();
        $this->view->assign('quizAnswers', $items);
        $this->logger->info('Quiz answers listed');
        return $this->htmlResponse();
    }

    /**
     * Shows a specific quiz answer.
     */
    public function showAction(QuizAnswer $quizAnswer): ResponseInterface
    {
        $this->view->assign('quizAnswer', $quizAnswer);
        $this->logger->info('Quiz answer shown', ['id' => $quizAnswer->getUid()]);
        return $this->htmlResponse();
    }

    /**
     * Creates a new quiz answer.
     */
    public function createAction(QuizAnswer $quizAnswer): ResponseInterface
    {
        $this->quizAnswerRepository->add($quizAnswer);

        $this->addFlashMessage(
            LocalizationUtility::translate('quizAnswer.created', 'equed_lms') ?? 'Answer created.',
            '',
            AbstractMessage::OK
        );

        $this->logger->info('Quiz answer created', ['text' => $quizAnswer->getAnswerText()]);
        return $this->redirect('list');
    }

    /**
     * Updates an existing quiz answer.
     */
    public function updateAction(QuizAnswer $quizAnswer): ResponseInterface
    {
        $this->quizAnswerRepository->update($quizAnswer);

        $this->addFlashMessage(
            LocalizationUtility::translate('quizAnswer.updated', 'equed_lms') ?? 'Answer updated.',
            '',
            AbstractMessage::OK
        );

        $this->logger->info('Quiz answer updated', ['id' => $quizAnswer->getUid()]);
        return $this->redirect('list');
    }

    /**
     * Deletes a quiz answer.
     */
    public function deleteAction(QuizAnswer $quizAnswer): ResponseInterface
    {
        $this->quizAnswerRepository->remove($quizAnswer);

        $this->addFlashMessage(
            LocalizationUtility::translate('quizAnswer.deleted', 'equed_lms') ?? 'Answer deleted.',
            '',
            AbstractMessage::WARNING
        );

        $this->logger->warning('Quiz answer deleted', ['id' => $quizAnswer->getUid()]);
        return $this->redirect('list');
    }
}
