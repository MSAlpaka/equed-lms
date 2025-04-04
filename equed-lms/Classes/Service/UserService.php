<?php

declare(strict_types=1);

namespace Equed\EquedLms\Service;

use Equed\EquedLms\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Persistence\Repository;
use Psr\Log\LoggerInterface;

/**
 * Service to manage user data and roles
 */
class UserService
{
    public function __construct(
        private readonly Repository $userRepository,
        private readonly LoggerInterface $logger
    ) {}

    /**
     * Find a user by their ID
     *
     * @param int $userId
     * @return FrontendUser|null
     */
    public function getUserById(int $userId): ?FrontendUser
    {
        try {
            return $this->userRepository->findByUid($userId);
        } catch (\Throwable $e) {
            $this->logger->error('Error finding user by ID', [
                'userId' => $userId,
                'error' => $e->getMessage(),
            ]);
            return null;
        }
    }

    /**
     * Get all users assigned to a specific course
     *
     * @param int $courseId
     * @return FrontendUser[] 
     */
    public function getUsersByCourse(int $courseId): array
    {
        // Example logic: Fetch users enrolled in a course from a CourseUserRepository
        // $courseUsers = $this->courseUserRepository->findByCourse($courseId);
        // return $courseUsers;

        // Placeholder: Add actual logic for retrieving users based on course ID
        return [];
    }
}