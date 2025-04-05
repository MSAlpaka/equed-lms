<?php

declare(strict_types=1);

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractConditionViewHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use Equed\EquedLms\Service\RoleService;
use TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository;

class HasPermissionViewHelper extends AbstractConditionViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('permission', 'string', 'The permission key to check', true);
        $this->registerArgument('user', FrontendUser::class, 'Optional user object', false);
    }

    /**
     * @return bool
     */
    protected function evaluateCondition(): bool
    {
        /** @var RoleService $roleService */
        $roleService = GeneralUtility::makeInstance(RoleService::class);
        $user = $this->arguments['user'] ?? $this->getCurrentFrontendUser();

        if (!$user instanceof \TYPO3\CMS\Extbase\Domain\Model\FrontendUser) {
            return false;
        }

        return $roleService->hasPermission($user, $this->arguments['permission']);
    }

    /**
     * Returns the currently logged-in frontend user, if any.
     */
    protected function getCurrentFrontendUser(): ?\TYPO3\CMS\Extbase\Domain\Model\FrontendUser
    {
        $userId = $GLOBALS['TSFE']->fe_user->user['uid'] ?? null;

        if (!$userId) {
            return null;
        }

        /** @var FrontendUserRepository $repo */
        $repo = GeneralUtility::makeInstance(FrontendUserRepository::class);
        return $repo->findByUid((int)$userId);
    }
}