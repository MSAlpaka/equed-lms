<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Model\QuizQuestion;
use EquedLms\Domain\Repository\QuizQuestionRepository;
use Psr\Log\LoggerInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class QuizQuestionController extends ActionController
{
    protected QuizQuestionRepository $quizQuestionRepository;

    public function __construct(QuizQuestionRepository $quizQuestionRepository)
    {
        $this->quizQuestionRepository = $quizQuestionRepository;
    }

    public function listAction(): void
    {
        $items = $this->quizQuestionRepository->findAll();
        $this->view->assign('quizQuestions', $items);
    }

    public function showAction(QuizQuestion $quizQuestion): void
    {
        $this->view->assign('quizQuestion', $quizQuestion);
    }

    public function createAction(QuizQuestion $quizQuestion): void
    {
        $this->quizQuestionRepository->add($quizQuestion);
        $this->redirect('list');
    }

    public function updateAction(QuizQuestion $quizQuestion): void
    {
        $this->quizQuestionRepository->update($quizQuestion);
        $this->redirect('list');
    }

    public function deleteAction(QuizQuestion $quizQuestion): void
    {
        $this->quizQuestionRepository->remove($quizQuestion);
        $this->redirect('list');
    }
}