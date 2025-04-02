<?php

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Equed\EquedLms\Domain\Repository\ExamAttemptRepository;

class QuizAttemptController extends ActionController
{
    /**
     * @var \Equed\EquedLms\Domain\Repository\ExamAttemptRepository
     */
    protected ExamAttemptRepository $examAttemptRepository;

    public function __construct(ExamAttemptRepository $examAttemptRepository)
    {
        $this->examAttemptRepository = $examAttemptRepository;
    }

    /**
     * List all attempts for a user
     */
    public function indexAction(int $userId): void
    {
        $attempts = $this->examAttemptRepository->findByUser($userId);
        $this->view->assign('attempts', $attempts);
    }

    /**
     * Show specific attempt details
     */
    public function showAction(int $userId, int $questionId): void
    {
        $attempt = $this->examAttemptRepository->findByUserAndQuestion($userId, $questionId);
        $this->view->assign('attempt', $attempt);
    }
}