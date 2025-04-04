<?php

declare(strict_types=1);

namespace Equed\EquedLms\Service;

use Equed\EquedLms\Domain\Model\ExamAttempt;
use Equed\EquedLms\Domain\Repository\ExamAttemptRepository;

/**
 * Service for exam-related logic
 */
class ExamService
{
    public function __construct(
        private readonly ExamAttemptRepository $examAttemptRepository
    ) {}

    /**
     * Get all exam attempts for a user
     *
     * @param int $userId
     * @return ExamAttempt[]
     */
    public function getAttemptsForUser(int $userId): array
    {
        return $this->examAttemptRepository->findByUser($userId);
    }

    /**
     * Check if a user has correctly answered a specific exam question
     *
     * @param int $userId
     * @param int $questionId
     * @return bool
     */
    public function hasUserPassedQuestion(int $userId, int $questionId): bool
    {
        $attempts = $this->examAttemptRepository->findByUserAndQuestion($userId, $questionId);

        return !empty($attempts) && $attempts[0]->getCorrect() === true;
    }
}