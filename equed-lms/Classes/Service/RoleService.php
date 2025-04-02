<?php

declare(strict_types=1);

namespace Equed\EquedLms\Service;

use Equed\EquedLms\Domain\Model\UserCourseRecord;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository;

class RoleService
{
    public function __construct(
        protected FrontendUserRepository $frontendUserRepository,
        protected PersistenceManager $persistenceManager,
        protected ConfigurationManagerInterface $configurationManager
    ) {}

    public function assignRolesForRecord(UserCourseRecord $record): void
    {
        $courseId = $record->getCourse()?->getUid();
        $user = $record->getUser();

        if (!$courseId || !$user) {
            return;
        }

        $settings = $this->configurationManager->getConfiguration(
            ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS,
            'EquedLms'
        );

        $map = $settings['courseRoles'] ?? [];

        if (!isset($map[$courseId])) {
            return;
        }

        $groupUids = GeneralUtility::intExplode(',', $map[$courseId], true);
        $existingGroups = $user->getUsergroup()->toArray();

        foreach ($groupUids as $uid) {
            $group = GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Domain\Model\FrontendUserGroup::class);
            $group->setUid($uid);
            $existingGroups[] = $group;
        }

        $user->setUsergroup($existingGroups);
        $this->frontendUserRepository->update($user);
        $this->persistenceManager->persistAll();
    }
}