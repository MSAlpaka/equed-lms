<?php

declare(strict_types=1);

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Equed\EquedLms\Domain\Repository\UserRepository;
use Equed\EquedLms\Domain\Repository\CourseRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Exception\AccessDeniedException;

/**
 * Controller handling administrative functions like dashboard and management tasks.
 */
class AdminController extends ActionController
{
    protected UserRepository $userRepository;
    protected CourseRepository $courseRepository;

    public function __construct(UserRepository $userRepository, CourseRepository $courseRepository)
    {
        $this->userRepository = $userRepository;
        $this->courseRepository = $courseRepository;
    }

    /**
     * Displays the admin dashboard with an overview of active courses and users.
     */
    public function indexAction(): void
    {
        $dashboardData = [
            'activeCourses' => $this->courseRepository->findActiveCourses(),
            'activeUsers' => $this->userRepository->findActiveUsers(),
            'statistics' => [
                'totalUsers' => $this->userRepository->countAll(),
                'totalCourses' => $this->courseRepository->countAll(),
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
            'users' => $this->userRepository->findAll(),
            'courses' => $this->courseRepository->findAll(),
        ];

        $this->view->assign('manageData', $managementData);
    }
}