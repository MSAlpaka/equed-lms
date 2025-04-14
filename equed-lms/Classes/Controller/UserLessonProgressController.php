<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use EquedLms\Domain\Repository\UserLessonProgressRepository;
use TYPO3\CMS\Core\Error\Http\PageNotFoundException;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ResponseInterface;

class UserLessonProgressController extends ActionController
{
    public function __construct(
        protected readonly UserLessonProgressRepository $userLessonProgressRepository,
        protected readonly LoggerInterface $logger
    ) {}

    /**
     * Display progress overview for a specific user
     *
     * @param int $userId ID of the user whose progress is shown
     * @throws PageNotFoundException if access is denied
     */
    public function indexAction(int $userId): ResponseInterface
    {
        if (!$this->isCurrentUser($userId)) {
            $this->logUnauthorizedAccess($userId, 'indexAction');
            throw new PageNotFoundException('Access denied.');
        }

        $progress = $this->userLessonProgressRepository->findCompletedByUser($userId);
        $this->view->assign('progress', $progress);

        return $this->htmlResponse();
    }

    /**
     * Display progress for a specific lesson and user
     *
     * @param int $userId ID of the user
     * @param int $lessonId ID of the lesson
     * @throws PageNotFoundException if lesson progress not found or access is denied
     */
    public function showAction(int $userId, int $lessonId): ResponseInterface
    {
        if (!$this->isCurrentUser($userId)) {
            $this->logUnauthorizedAccess($userId, 'showAction');
            throw new PageNotFoundException('Access denied.');
        }

        $lessonProgress = $this->userLessonProgressRepository->findByUserAndLesson($userId, $lessonId);

        if ($lessonProgress === null) {
            $this->logger->warning('Lesson progress not found', [
                'userId' => $userId,
                'lessonId' => $lessonId
            ]);
            throw new PageNotFoundException('Lesson progress not found.');
        }

        $this->view->assign('lessonProgress', $lessonProgress);
        return $this->htmlResponse();
    }

    /**
     * Checks if the given userId belongs to the currently logged-in frontend user
     */
    protected function isCurrentUser(int $userId): bool
    {
        $currentUserId = (int)($GLOBALS['TSFE']->fe_user->user['uid'] ?? 0);
        return $currentUserId > 0 && $currentUserId === $userId;
    }

    /**
     * Logs an unauthorized access attempt
     */
    protected function logUnauthorizedAccess(int $targetUserId, string $action): void
    {
        $currentUserId = (int)($GLOBALS['TSFE']->fe_user->user['uid'] ?? 0);

        $this->logger->warning(sprintf(
            'Unauthorized access attempt in %s by user %d to data of user %d.',
            $action,
            $currentUserId,
            $targetUserId
        ));
    }
}
