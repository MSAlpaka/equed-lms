<?php

namespace Equed\EquedLms\Service;

use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Persistence\Repository;

class UserService
{
    /**
     * @var \TYPO3\CMS\Extbase\Persistence\Repository
     */
    protected Repository $userRepository;

    public function __construct(Repository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Find user by ID
     */
    public function getUserById(int $userId): ?FrontendUser
    {
        return $this->userRepository->findByUid($userId);
    }

    /**
     * Find all users assigned to a course
     */
    public function getUsersByCourse(int $courseId): array
    {
        // Logic to get all users enrolled in a course
        return [];
    }
}