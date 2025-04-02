<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class UserNameViewHelper extends AbstractViewHelper
{
    /**
     * @param int $userId
     * @return string
     */
    public function render(int $userId): string
    {
        // Fetch user name by ID
        $user = $this->getUserById($userId);
        return $user ? $user->getFullName() : 'Unknown User';
    }

    /**
     * Fetch user data by ID
     *
     * @param int $userId
     * @return \TYPO3\CMS\Extbase\Domain\Model\FrontendUser|null
     */
    protected function getUserById(int $userId)
    {
        $userRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository::class);
        return $userRepository->findByUid($userId);
    }
}