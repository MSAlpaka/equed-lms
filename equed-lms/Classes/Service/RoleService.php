<?php

declare(strict_types=1);

namespace Equed\EquedLms\Service;

use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use Psr\Log\LoggerInterface;

/**
 * Service to manage user roles
 */
class RoleService
{
    public function __construct(
        private readonly Repository $userRepository,
        private readonly LoggerInterface $logger
    ) {}

    /**
     * Assign a role to a user
     *
     * @param int $userId
     * @param string $role
     */
    public function assignRoleToUser(int $userId, string $role): void
    {
        /** @var FrontendUser|null $user */
        $user = $this->userRepository->findByUid($userId);

        if ($user === null) {
            $this->logger->error("User not found for ID $userId");
            throw new \RuntimeException("User not found");
        }

        $user->setRole($role);
        $this->userRepository->update($user);
    }

    /**
     * Check if a user has a specific role
     *
     * @param int $userId
     * @param string $role
     * @return bool
     */
    public function userHasRole(int $userId, string $role): bool
    {
        /** @var FrontendUser|null $user */
        $user = $this->userRepository->findByUid($userId);

        if ($user === null) {
            $this->logger->error("User not found for ID $userId");
            return false;
        }

        return $user->getRole() === $role;
    }
}