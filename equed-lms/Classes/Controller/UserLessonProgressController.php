<?php

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Equed\EquedLms\Domain\Repository\UserLessonProgressRepository;
use TYPO3\CMS\Core\Error\Http\PageNotFoundException;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Log\LogManager;

/**
 * Controller for handling lesson progress of users
 */
class UserLessonProgressController extends ActionController
{
    protected UserLessonProgressRepository $userLessonProgressRepository;

    public function __construct(UserLessonProgressRepository $userLessonProgressRepository)
    {
        $this->userLessonProgressRepository = $userLessonProgressRepository;
    }

    /**
     * Display progress overview for a specific user
     *
     * @param int $userId ID of the user whose progress is shown
     * @throws PageNotFoundException if access is denied
     */
    public function indexAction(int $userId): void
    {
        if (!$this->isCurrentUser($userId)) {
            $this->logUnauthorizedAccess($userId, 'indexAction');
            throw new PageNotFoundException('Access denied.');
        }

        $progress = $this->userLessonProgressRepository->findCompletedByUser($userId);
        $this->view->assign('progress', $progress);
    }

    /**
     * Display progress for a specific lesson and user
     *
     * @param int $userId ID of the user
     * @param int $lessonId ID of the lesson
     * @throws PageNotFoundException if lesson progress not found or access is denied
     */
    public function showAction(int $userId, int $lessonId): void
    {
        if (!$this->isCurrentUser($userId)) {
            $this->logUnauthorizedAccess($userId, 'showAction');
            throw new PageNotFoundException('Access denied.');
        }

        $lessonProgress = $this->userLessonProgressRepository->findByUserAndLesson($userId, $lessonId);

        if ($lessonProgress === null) {
            throw new PageNotFoundException('Lesson progress not found.');
        }

        $this->view->assign('lessonProgress', $lessonProgress);
    }

    /**
     * Checks if the given userId belongs to the currently logged-in frontend user
     *
     * @param int $userId
     * @return bool
     */
    protected function isCurrentUser(int $userId): bool
    {
        $currentUserId = (int)($GLOBALS['TSFE']->fe_user->user['uid'] ?? 0);
        return $currentUserId > 0 && $currentUserId === $userId;
    }

    /**
     * Logs an unauthorized access attempt
     *
     * @param int $targetUserId
     * @param string $action
     * @return void
     */
    protected function logUnauthorizedAccess(int $targetUserId, string $action): void
    {
        $logger = GeneralUtility::makeInstance(LogManager::class)->getLogger(__CLASS__);
        $currentUserId = (int)($GLOBALS['TSFE']->fe_user->user['uid'] ?? 0);

        $logger->warning(sprintf(
            'Unauthorized access attempt in %s by user %d to data of user %d.',
            $action,
            $currentUserId,
            $targetUserId
        ));
    }
}