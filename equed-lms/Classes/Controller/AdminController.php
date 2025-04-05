<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use EquedLms\Domain\Repository\FrontendUserRepository;
use EquedLms\Domain\Repository\CourseProgramRepository;
use EquedLms\Domain\Repository\CourseInstanceRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Exception\AccessDeniedException;

/**
 * Controller handling administrative functions like dashboard and management tasks.
 */
class AdminController extends ActionController
{
    protected FrontendUserRepository $frontendUserRepository;
    protected CourseProgramRepository $courseProgramRepository;
    protected CourseInstanceRepository $courseInstanceRepository;

    public function __construct(
        FrontendUserRepository $frontendUserRepository,
        CourseProgramRepository $courseProgramRepository,
        CourseInstanceRepository $courseInstanceRepository
    ) {
        $this->frontendUserRepository = $frontendUserRepository;
        $this->courseProgramRepository = $courseProgramRepository;
        $this->courseInstanceRepository = $courseInstanceRepository;
    }

    /**
     * Displays the admin dashboard with an overview of active courses and users.
     */
    public function indexAction(): void
    {
        $dashboardData = [
            'activeCourses' => $this->courseInstanceRepository->findUpcoming(),
            'activeUsers' => $this->frontendUserRepository->findActiveUsers(),
            'statistics' => [
                'totalUsers' => $this->frontendUserRepository->countAll(),
                'totalCoursePrograms' => $this->courseProgramRepository->countAll(),
                'totalCourseInstances' => $this->courseInstanceRepository->countAll(),
            ],
        ];

        $this->view->assign('adminDashboardData', $dashboardData);
    }

    /**
     * Provides management functions for users and courses.
     * Access restricted to admin users only.
     *
     * @throws AccessDeniedException
     */
    public function manageAction(): void
    {
        $context = GeneralUtility::makeInstance(Context::class);
        if (!$context->getPropertyFromAspect('frontend.user', 'isLoggedIn') ||
            !$context->getPropertyFromAspect('frontend.user', 'isAdmin')) {
            throw new AccessDeniedException('Access denied: Admin only');
        }

        $managementData = [
            'users' => $this->frontendUserRepository->findAll(),
            'coursePrograms' => $this->courseProgramRepository->findAll(),
            'courseInstances' => $this->courseInstanceRepository->findAll(),
        ];

        $this->view->assign('manageData', $managementData);
    }
}