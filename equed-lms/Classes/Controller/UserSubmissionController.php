<?php

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use Equed\EquedLms\Domain\Repository\UserSubmissionRepository;

class UserSubmissionController extends ActionController
{
    protected UserSubmissionRepository $userSubmissionRepository;

    public function __construct(UserSubmissionRepository $userSubmissionRepository)
    {
        $this->userSubmissionRepository = $userSubmissionRepository;
    }

    /**
     * List all submissions for a specific user and course.
     *
     * @param int $userId
     * @param int $courseId
     */
    public function indexAction(int $userId, int $courseId): void
    {
        if (!$this->checkUserPermission($userId)) {
            $this->addFlashMessage(
                $this->translate('error.no_permission'),
                '',
                AbstractMessage::ERROR
            );
            $this->redirect('dashboard', 'UserDashboard');
            return;
        }

        $submissions = $this->userSubmissionRepository->findByUserAndCourse($userId, $courseId);

        if ($submissions->isEmpty()) {
            $this->addFlashMessage(
                $this->translate('notice.no_submissions_found'),
                '',
                AbstractMessage::NOTICE
            );
        }

        $this->view->assign('submissions', $submissions);
    }

    /**
     * Show details for a specific submission.
     *
     * @param int $submissionId
     */
    public function showAction(int $submissionId): void
    {
        $submission = $this->userSubmissionRepository->findByIdentifier($submissionId);

        if (!$submission) {
            $this->addFlashMessage(
                $this->translate('error.submission_not_found'),
                '',
                AbstractMessage::ERROR
            );
            $this->redirect('index');
            return;
        }

        if (!$this->checkUserPermission($submission->getUser()->getUid())) {
            $this->addFlashMessage(
                $this->translate('error.no_access_to_submission'),
                '',
                AbstractMessage::ERROR
            );
            $this->redirect('dashboard', 'UserDashboard');
            return;
        }

        $this->view->assign('submission', $submission);
    }

    /**
     * Check if current user has permission to access the data of the given user.
     *
     * @param int $userId
     * @return bool
     */
    protected function checkUserPermission(int $userId): bool
    {
        $currentUserId = (int)($GLOBALS['TSFE']->fe_user->user['uid'] ?? 0);
        return $currentUserId === $userId || $this->isUserInstructorOrAdmin();
    }

    /**
     * Check if the current user is an Instructor or Admin.
     *
     * @return bool
     */
    protected function isUserInstructorOrAdmin(): bool
    {
        $userGroups = explode(',', $GLOBALS['TSFE']->fe_user->user['usergroup'] ?? '');
        $allowedGroups = [/* TODO: define group UIDs for instructors/admins */];

        return !empty(array_intersect($userGroups, $allowedGroups));
    }

    /**
     * Translate a language label from the locallang files.
     *
     * @param string $key
     * @param array $arguments
     * @return string
     */
    protected function translate(string $key, array $arguments = []): string
    {
        return $this->getLanguageService()->sL('LLL:EXT:equed_lms/Resources/Private/Language/locallang.xlf:' . $key, $arguments)
            ?? $key;
    }

    /**
     * Get TYPO3 language service.
     *
     * @return \TYPO3\CMS\Core\Localization\LanguageService
     */
    protected function getLanguageService(): \TYPO3\CMS\Core\Localization\LanguageService
    {
        return $GLOBALS['LANG'] ?? $GLOBALS['TSFE']->getLanguageService();
    }
}