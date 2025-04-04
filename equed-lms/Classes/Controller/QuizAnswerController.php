<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Model\QuizAnswer;
use EquedLms\Domain\Repository\QuizAnswerRepository;
use Psr\Log\LoggerInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class QuizAnswerController extends ActionController
{
    protected QuizAnswerRepository $quizAnswerRepository;

    public function __construct(QuizAnswerRepository $quizAnswerRepository)
    {
        $this->quizAnswerRepository = $quizAnswerRepository;
    }

    public function listAction(): void
    {
        $items = $this->quizAnswerRepository->findAll();
        $this->view->assign('quizAnswers', $items);
    }

    public function showAction(QuizAnswer $quizAnswer): void
    {
        $this->view->assign('quizAnswer', $quizAnswer);
    }

    public function createAction(QuizAnswer $quizAnswer): void
    {
        $this->quizAnswerRepository->add($quizAnswer);
        $this->redirect('list');
    }

    public function updateAction(QuizAnswer $quizAnswer): void
    {
        $this->quizAnswerRepository->update($quizAnswer);
        $this->redirect('list');
    }

    public function deleteAction(QuizAnswer $quizAnswer): void
    {
        $this->quizAnswerRepository->remove($quizAnswer);
        $this->redirect('list');
    }
}