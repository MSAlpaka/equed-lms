<?php

declare(strict_types=1);

namespace Equed\EquedLms\Service;

use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Persistence\Repository;
use Psr\Log\LoggerInterface;
use Equed\EquedLms\Configuration\AccessControl\RoleMap;

class RoleService
{
    public function __construct(
        private readonly Repository $userRepository,
        private readonly LoggerInterface $logger
    ) {}

    /**
     * Assigns a role to a user and updates the repository.
     */
    public function assignRoleToUser(int $userId, string $role): void
    {
        /** @var FrontendUser|null $user */
        $user = $this->userRepository->findByUid($userId);

        if (!$user instanceof FrontendUser) {
            $this->logger->error("User not found for ID {$userId}");
            throw new \RuntimeException("User not found");
        }

        $user->setRole($role);
        $this->userRepository->update($user);
    }

    /**
     * Checks if a user has a specific role.
     */
    public function hasRole(FrontendUser $user, string $role): bool
    {
        return $user->getRole() === $role;
    }

    /**
     * Returns the role name for a given user, or "learner" as fallback.
     */
    public function getUserRole(FrontendUser $user): string
    {
        return $user->getRole() ?? 'learner';
    }

    /**
     * Returns all permissions for a given user.
     *
     * @return string[]
     */
    public function getPermissionsForUser(FrontendUser $user): array
    {
        $role = $this->getUserRole($user);
        return RoleMap::getPermissionsForRole($role);
    }

    /**
     * Checks if a user has a specific permission.
     */
    public function hasPermission(FrontendUser $user, string $permission): bool
    {
        $permissions = $this->getPermissionsForUser($user);
        return in_array('*', $permissions, true) || in_array($permission, $permissions, true);
    }

    /**
     * Returns the human-readable title of the user's role.
     */
    public function getRoleTitleForUser(FrontendUser $user): string
    {
        return RoleMap::getRoleTitle($this->getUserRole($user));
    }
}