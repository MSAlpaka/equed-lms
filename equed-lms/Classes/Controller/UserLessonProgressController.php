<?php

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Equed\EquedLms\Domain\Repository\UserLessonProgressRepository;

class UserLessonProgressController extends ActionController
{
    /**
     * @var \Equed\EquedLms\Domain\Repository\UserLessonProgressRepository
     */
    protected UserLessonProgressRepository $userLessonProgressRepository;

    public function __construct(UserLessonProgressRepository $userLessonProgressRepository)
    {
        $this->userLessonProgressRepository = $userLessonProgressRepository;
    }

    /**
     * Show progress for a user
     */
    public function indexAction(int $userId): void
    {
        $progress = $this->userLessonProgressRepository->findCompletedByUser($userId);
        $this->view->assign('progress', $progress);
    }

    /**
     * Show specific lesson progress
     */
    public function showAction(int $userId, int $lessonId): void
    {
        $lessonProgress = $this->userLessonProgressRepository->findByUserAndLesson($userId, $lessonId);
        $this->view->assign('lessonProgress', $lessonProgress);
    }
}