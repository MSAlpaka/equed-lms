<?php

namespace Equed\EquedLms\Service;

use Equed\EquedLms\Domain\Repository\ExamAttemptRepository;

class ExamService
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
     * Get all attempts for a specific user
     */
    public function getAttemptsForUser(int $userId): array
    {
        return $this->examAttemptRepository->findByUser($userId);
    }

    /**
     * Check if the user has passed a specific exam question
     */
    public function hasUserPassedQuestion(int $userId, int $questionId): bool
    {
        $attempts = $this->examAttemptRepository->findByUserAndQuestion($userId, $questionId);
        return !empty($attempts) && $attempts[0]->getCorrect() === true;
    }
}