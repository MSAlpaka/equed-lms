<?php
namespace Equed\EquedLms\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository;
use TYPO3\CMS\Extbase\Object\ObjectManager;

class UserNameViewHelper extends AbstractViewHelper
{
    protected ObjectManager $objectManager;

    public function initializeArguments(): void
    {
        $this->registerArgument('feUserId', 'int', 'UID des FE-Users', true);
    }

    public function render(): string
    {
        $feUserId = $this->arguments['feUserId'];

        /** @var FrontendUserRepository $userRepo */
        $userRepo = $this->objectManager->get(FrontendUserRepository::class);
        $user = $userRepo->findByUid($feUserId);

        if ($user === null) {
            return '[User #' . $feUserId . ']';
        }

        $name = trim($user->getName() ?: '');
        if ($name !== '') {
            return $name;
        }

        return $user->getEmail() ?: '[User #' . $feUserId . ']';
    }
}