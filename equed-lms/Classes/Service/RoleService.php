<?php

namespace Equed\EquedLms\Service;

use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Persistence\Repository;

class RoleService
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
     * Assign a role to a user
     */
    public function assignRoleToUser(int $userId, string $role): void
    {
        // Logic to assign the role to a user
        $user = $this->userRepository->findByUid($userId);
        $user->setRole($role);
        $this->userRepository->update($user);
    }

    /**
     * Check if a user has a specific role
     */
    public function userHasRole(int $userId, string $role): bool
    {
        $user = $this->userRepository->findByUid($userId);
        return $user->getRole() === $role;
    }
}