<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository;
use Psr\Log\LoggerInterface;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Core\Authentication\FrontendUserAuthentication;
use TYPO3\CMS\Core\Exception\AccessDeniedException;

class FrontendUserController extends ActionController
{
    public function __construct(
        protected readonly FrontendUserRepository $frontendUserRepository,
        protected readonly LoggerInterface $logger
    ) {}

    /**
     * Zeigt die Daten des aktuellen Frontend-Benutzers an.
     */
    public function showAction(): void
    {
        $user = $this->getFrontendUser();
        if (!$user) {
            $this->addFlashMessage(
                LocalizationUtility::translate('flashMessages.userNotFound', 'EquedLms') ?? 'Benutzer nicht gefunden.',
                '',
                AbstractMessage::ERROR
            );
            $this->redirect('index');
        }

        $this->view->assign('user', $user);
        $this->logger->info('Frontend user details displayed', ['userId' => $user->getUid()]);
    }

    /**
     * Bearbeitet die Daten eines Frontend-Benutzers.
     */
    public function editAction(FrontendUser $user): void
    {
        $this->checkAccess($user);

        $this->view->assign('user', $user);
        $this->logger->info('Edit frontend user', ['userId' => $user->getUid()]);
    }

    /**
     * Speichert die Änderungen eines Frontend-Benutzers.
     */
    public function updateAction(FrontendUser $user): void
    {
        $this->checkAccess($user);

        $this->frontendUserRepository->update($user);
        $this->addFlashMessage(
            LocalizationUtility::translate('flashMessages.userUpdated', 'EquedLms') ?? 'Benutzerdaten erfolgreich aktualisiert.',
            '',
            AbstractMessage::OK
        );

        $this->logger->info('Frontend user updated', ['userId' => $user->getUid()]);
        $this->redirect('show');
    }

    /**
     * Löscht einen Frontend-Benutzer.
     */
    public function deleteAction(FrontendUser $user): void
    {
        $this->checkAccess($user);

        $this->frontendUserRepository->remove($user);
        $this->addFlashMessage(
            LocalizationUtility::translate('flashMessages.userDeleted', 'EquedLms') ?? 'Benutzer erfolgreich gelöscht.',
            '',
            AbstractMessage::WARNING
        );

        $this->logger->info('Frontend user deleted', ['userId' => $user->getUid()]);
        $this->redirect('index');
    }

    /**
     * Überprüft, ob der Benutzer berechtigt ist, die Aktion auszuführen.
     *
     * @throws AccessDeniedException
     */
    protected function checkAccess(FrontendUser $user): void
    {
        $currentUser = $this->getFrontendUser();
        if (!$currentUser || $currentUser->getUid() !== $user->getUid()) {
            throw new AccessDeniedException('Zugriff verweigert: Du kannst nur deinen eigenen Account bearbeiten.');
        }
    }

    /**
     * Gibt den aktuellen Frontend-User zurück.
     */
    protected function getFrontendUser(): ?FrontendUserAuthentication
    {
        return $GLOBALS['TSFE']->fe_user ?? null;
    }
}