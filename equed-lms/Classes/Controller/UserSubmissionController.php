<?php

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Equed\EquedLms\Domain\Repository\UserSubmissionRepository;

class UserSubmissionController extends ActionController
{
    /**
     * @var \Equed\EquedLms\Domain\Repository\UserSubmissionRepository
     */
    protected UserSubmissionRepository $userSubmissionRepository;

    public function __construct(UserSubmissionRepository $userSubmissionRepository)
    {
        $this->userSubmissionRepository = $userSubmissionRepository;
    }

    /**
     * List all submissions for a user and course
     */
    public function indexAction(int $userId, int $courseId): void
    {
        $submissions = $this->userSubmissionRepository->findByUserAndCourse($userId, $courseId);
        $this->view->assign('submissions', $submissions);
    }

    /**
     * Show specific submission details
     */
    public function showAction(int $submissionId): void
    {
        $submission = $this->userSubmissionRepository->findByIdentifier($submissionId);
        $this->view->assign('submission', $submission);
    }
}