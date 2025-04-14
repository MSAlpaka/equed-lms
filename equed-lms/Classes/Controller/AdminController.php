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
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ResponseInterface;

class AdminController extends ActionController
{
    public function __construct(
        protected readonly FrontendUserRepository $frontendUserRepository,
        protected readonly CourseProgramRepository $courseProgramRepository,
        protected readonly CourseInstanceRepository $courseInstanceRepository,
        protected readonly LoggerInterface $logger
    ) {}

    /**
     * Displays the admin dashboard with stats on courses and users.
     */
    public function indexAction(): ResponseInterface
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
        $this->logger->info('Admin dashboard loaded');
        return $this->htmlResponse();
    }

    /**
     * Provides admin-only access to full course/user management.
     *
     * @throws AccessDeniedException
     */
    public function manageAction(): ResponseInterface
    {
        if (!$this->isAdminUser()) {
            $this->logger->warning('Access denied in manageAction: non-admin user attempted access.');
            throw new AccessDeniedException('Access denied: Admin only');
        }

        $managementData = [
            'users' => $this->frontendUserRepository->findAll(),
            'coursePrograms' => $this->courseProgramRepository->findAll(),
            'courseInstances' => $this->courseInstanceRepository->findAll(),
        ];

        $this->view->assign('manageData', $managementData);
        $this->logger->info('Admin management data rendered');
        return $this->htmlResponse();
    }

    /**
     * Returns true if the currently logged-in FE user is an admin.
     */
    protected function isAdminUser(): bool
    {
        $context = GeneralUtility::makeInstance(Context::class);
        $userGroupIds = $context->getPropertyFromAspect('frontend.user', 'usergroup') ?? [];

        // Adjust based on your actual admin group ID
        return in_array(1, (array)$userGroupIds, true); // Group ID 1 = Admin
    }
}
