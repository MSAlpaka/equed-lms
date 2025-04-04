<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Model\ExamAttempt;
use EquedLms\Domain\Repository\ExamAttemptRepository;
use Psr\Log\LoggerInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class ExamAttemptController extends ActionController
{
    protected ExamAttemptRepository $examAttemptRepository;

    public function __construct(ExamAttemptRepository $examAttemptRepository)
    {
        $this->examAttemptRepository = $examAttemptRepository;
    }

    public function listAction(): void
    {
        $items = $this->examAttemptRepository->findAll();
        $this->view->assign('examAttempts', $items);
    }

    public function showAction(ExamAttempt $examAttempt): void
    {
        $this->view->assign('examAttempt', $examAttempt);
    }

    public function createAction(ExamAttempt $examAttempt): void
    {
        $this->examAttemptRepository->add($examAttempt);
        $this->redirect('list');
    }

    public function updateAction(ExamAttempt $examAttempt): void
    {
        $this->examAttemptRepository->update($examAttempt);
        $this->redirect('list');
    }

    public function deleteAction(ExamAttempt $examAttempt): void
    {
        $this->examAttemptRepository->remove($examAttempt);
        $this->redirect('list');
    }
}