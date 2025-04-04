<?php

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Equed\EquedLms\Domain\Repository\ExamAttemptRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Messaging\AbstractMessage;

class QuizAttemptController extends ActionController
{
    protected ExamAttemptRepository $examAttemptRepository;

    public function __construct(ExamAttemptRepository $examAttemptRepository)
    {
        $this->examAttemptRepository = $examAttemptRepository;
    }

    /**
     * Lists all quiz attempts for a user with pagination support.
     *
     * @param int $userId The user ID to fetch attempts for
     */
    public function indexAction(int $userId, int $currentPage = 1): void
    {
        // Berechtigung prüfen
        if (!$this->isAuthorized($userId)) {
            $this->addFlashMessage('Access denied.', '', AbstractMessage::ERROR);
            $this->redirect('error');
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
    }

    /**
     * Shows details of a specific quiz attempt.
     *
     * @param int $userId The user ID related to the attempt
     * @param int $questionId The question ID of the specific attempt
     */
    public function showAction(int $userId, int $questionId): void
    {
        // Berechtigung prüfen
        if (!$this->isAuthorized($userId)) {
            $this->addFlashMessage('Access denied.', '', AbstractMessage::ERROR);
            $this->redirect('error');
        }

        $attempt = $this->examAttemptRepository->findByUserAndQuestion($userId, $questionId);
        
        if ($attempt === null) {
            $this->addFlashMessage('Attempt not found.', '', AbstractMessage::WARNING);
            $this->redirect('index', null, null, ['userId' => $userId]);
        }

        $this->view->assign('attempt', $attempt);
    }

    /**
     * Checks if the current user is authorized to view the quiz attempts.
     *
     * @param int $userId The user ID to check authorization for
     * @return bool
     */
    protected function isAuthorized(int $userId): bool
    {
        $currentUser = $this->getFrontendUser();
        return $currentUser && ($currentUser->isAdmin() || $currentUser->getUid() === $userId);
    }

    /**
     * Retrieves the currently logged-in frontend user.
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FrontendUser|null
     */
    protected function getFrontendUser()
    {
        return $GLOBALS['TSFE']->fe_user->user ? $this->objectManager->get(
            \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository::class
        )->findByUid((int)$GLOBALS['TSFE']->fe_user->user['uid']) : null;
    }
}