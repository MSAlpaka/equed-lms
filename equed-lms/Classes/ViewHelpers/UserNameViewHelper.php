<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository;

class UserNameViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('userId', 'int', 'Frontend User UID', true);
    }

    public function render(): string
    {
        $userId = (int)$this->arguments['userId'];
        $user = $this->getUserById($userId);

        return $user?->getFullName()
            ?? LocalizationUtility::translate('user.unknown', 'equed_lms')
            ?? 'Unknown User';
    }

    protected function getUserById(int $userId)
    {
        /** @var FrontendUserRepository $repo */
        $repo = GeneralUtility::makeInstance(FrontendUserRepository::class);
        return $repo->findByUid($userId);
    }
}