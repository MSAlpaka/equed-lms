<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Exception\AccessDeniedException;
use EquedLms\Domain\Repository\CourseInstanceRepository;
use EquedLms\Domain\Repository\FrontendUserRepository;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ResponseInterface;

class BackendController extends ActionController
{
    public function __construct(
        protected readonly CourseInstanceRepository $courseInstanceRepository,
        protected readonly FrontendUserRepository $frontendUserRepository,
        protected readonly LoggerInterface $logger
    ) {}

    /**
     * Displays the backend dashboard with course/user statistics.
     *
     * @throws AccessDeniedException
     */
    public function indexAction(): ResponseInterface
    {
        $this->checkAccess();

        $dashboardData = [
            'courseCount' => $this->courseInstanceRepository->countAll(),
            'activeUserCount' => $this->frontendUserRepository->countActiveUsers(),
            'completedCourses' => $this->courseInstanceRepository->countCompletedCourses(),
        ];

        $this->view->assignMultiple([
            'dashboardData' => $dashboardData,
        ]);

        $this->logger->info('Backend dashboard accessed');
        return $this->htmlResponse();
    }

    /**
     * Displays placeholder admin management section.
     *
     * @throws AccessDeniedException
     */
    public function manageAction(): ResponseInterface
    {
        $this->checkAccess();

        $this->view->assignMultiple([
            'managementData' => [
                'pendingValidations' => [],
                'openReports' => [],
            ],
        ]);

        $this->logger->info('Backend management view accessed');
        return $this->htmlResponse();
    }

    /**
     * Ensures only backend admin users have access.
     *
     * @throws AccessDeniedException
     */
    protected function checkAccess(): void
    {
        /** @var BackendUserAuthentication|null $backendUser */
        $backendUser = $GLOBALS['BE_USER'] ?? null;

        if (!$backendUser instanceof BackendUserAuthentication || !$backendUser->isAdmin()) {
            $this->logger->warning('Backend access denied for non-admin user');
            throw new AccessDeniedException(
                'Access denied: Only the main admin may access this section.',
                1670000051
            );
        }
    }
}
