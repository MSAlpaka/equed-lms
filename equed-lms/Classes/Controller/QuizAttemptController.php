<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Repository\ExamAttemptRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ResponseInterface;

class QuizAttemptController extends ActionController
{
    public function __construct(
        protected readonly ExamAttemptRepository $examAttemptRepository,
        protected readonly LoggerInterface $logger
    ) {}

    /**
     * Lists all quiz attempts for a user with pagination support.
     */
    public function indexAction(int $userId, int $currentPage = 1): ResponseInterface
    {
        if (!$this->isAuthorized($userId)) {
            $this->addFlashMessage(
                LocalizationUtility::translate('access.denied', 'equed_lms') ?? 'Access denied.',
                '',
                AbstractMessage::ERROR
            );
            $this->logger->warning('Unauthorized quiz attempt list access.', ['userId' => $userId]);
            return $this->redirect('index', 'Error');
        }

        $attemptsPerPage = 10;
        $totalAttempts = $this->examAttemptRepository->countByUser($userId);
        $attempts = $this->examAttemptRepository->findByUserWithPagination($userId, $attemptsPerPage, $currentPage);

        $this->view->assignMultiple([
            'attempts' => $attempts,
            'currentPage' => $currentPage,
            'totalAttempts' => $totalAttempts,
            'attemptsPerPage' => $attemptsPerPage
        ]);

        $this->logger->info('Quiz attempts listed', ['userId' => $userId, 'count' => count($attempts)]);
        return $this->htmlResponse();
    }

    /**
     * Shows details of a specific quiz attempt.
     */
    public function showAction(int $userId, int $questionId): ResponseInterface
    {
        if (!$this->isAuthorized($userId)) {
            $this->addFlashMessage(
                LocalizationUtility::translate('access.denied', 'equed_lms') ?? 'Access denied.',
                '',
                AbstractMessage::ERROR
            );
            $this->logger->warning('Unauthorized quiz attempt view.', ['userId' => $userId, 'questionId' => $questionId]);
            return $this->redirect('index');
        }

        $attempt = $this->examAttemptRepository->findByUserAndQuestion($userId, $questionId);

        if ($attempt === null) {
            $this->addFlashMessage(
                LocalizationUtility::translate('quiz.attempt_not_found', 'equed_lms') ?? 'Attempt not found.',
                '',
                AbstractMessage::WARNING
            );
            return $this->redirect('index', null, null, ['userId' => $userId]);
        }

        $this->view->assign('attempt', $attempt);
        $this->logger->info('Quiz attempt shown', ['userId' => $userId, 'questionId' => $questionId]);
        return $this->htmlResponse();
    }

    /**
     * Checks if the current user is authorized to view the quiz attempts.
     */
    protected function isAuthorized(int $userId): bool
    {
        $context = GeneralUtility::makeInstance(Context::class);
        $currentId = (int)($context->getPropertyFromAspect('frontend.user', 'id') ?? 0);
        return $currentId === $userId;
    }
}
