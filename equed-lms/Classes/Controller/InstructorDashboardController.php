<?php

declare(strict_types=1);

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Equed\EquedLms\Domain\Repository\InstructorRepository;
use Equed\EquedLms\Domain\Repository\UserCourseRecordRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Context\Context;

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

    protected function initializeAction(): void
    {
        $context = GeneralUtility::makeInstance(Context::class);
        $instructorId = (int)$context->getPropertyFromAspect('frontend.user', 'id');

        if (!$this->instructorRepository->isInstructor($instructorId)) {
            $this->redirect('accessDenied', 'Error');
        }
    }

    /**
     * Instructor Dashboard Overview
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
     * Instructor Performance Statistics
     */
    public function performanceAction(): void
    {
        $context = GeneralUtility::makeInstance(Context::class);
        $instructorId = (int)$context->getPropertyFromAspect('frontend.user', 'id');

        $stats = $this->instructorRepository->getPerformanceStats($instructorId);

        $this->view->assign('performanceStats', $stats);
    }

    /**
     * Access Denied Error Page
     */
    public function accessDeniedAction(): void
    {
        // Display access denied message
    }
}