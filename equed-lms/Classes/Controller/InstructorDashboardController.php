<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use EquedLms\Domain\Repository\InstructorRepository;
use EquedLms\Domain\Repository\UserCourseRecordRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Exception\AccessDeniedException;

class InstructorDashboardController extends ActionController
{
    protected InstructorRepository $instructorRepository;
    protected UserCourseRecordRepository $userCourseRecordRepository;

    public function __construct(
        InstructorRepository $instructorRepository,
        UserCourseRecordRepository $userCourseRecordRepository
    ) {
        $this->instructorRepository = $instructorRepository;
        $this->userCourseRecordRepository = $userCourseRecordRepository;
    }

    /**
     * Ensure only logged-in instructors can access the dashboard.
     */
    protected function initializeAction(): void
    {
        $context = GeneralUtility::makeInstance(Context::class);
        $instructorId = (int)$context->getPropertyFromAspect('frontend.user', 'id');

        if (!$this->instructorRepository->isInstructor($instructorId)) {
            $this->redirect('accessDenied', 'Error');
        }
    }

    /**
     * Instructor Dashboard Overview: Displays assigned courses and user statistics.
     */
    public function indexAction(): void
    {
        $context = GeneralUtility::makeInstance(Context::class);
        $instructorId = (int)$context->getPropertyFromAspect('frontend.user', 'id');

        $assignedCourses = $this->userCourseRecordRepository->findCoursesByInstructor($instructorId);

        $this->view->assignMultiple([
            'assignedCourses' => $assignedCourses,
            'instructor' => $this->instructorRepository->findByUid($instructorId)
        ]);
    }

    /**
     * Instructor Performance Statistics: Shows performance data like passed courses, ratings, etc.
     */
    public function performanceAction(): void
    {
        $context = GeneralUtility::makeInstance(Context::class);
        $instructorId = (int)$context->getPropertyFromAspect('frontend.user', 'id');

        $stats = $this->instructorRepository->getPerformanceStats($instructorId);

        $this->view->assign('performanceStats', $stats);
    }

    /**
     * Access Denied Error Page: Redirects or displays an access error message.
     */
    public function accessDeniedAction(): void
    {
        $this->view->assign('message', 'You do not have access to this page.');
    }
}