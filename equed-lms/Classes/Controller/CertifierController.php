<?php

declare(strict_types=1);

namespace Equed\EquedLms\Controller;

use Equed\EquedLms\Domain\Model\CourseInstance;
use Equed\EquedLms\Domain\Repository\CourseInstanceRepository;
use Psr\Log\LoggerInterface;
use TYPO3\CMS\Core\Authentication\FrontendUserAuthentication;
use TYPO3\CMS\Core\Exception\AccessDeniedException;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

class CertifierController extends ActionController
{
    public function __construct(
        protected readonly CourseInstanceRepository $courseInstanceRepository,
        protected readonly LoggerInterface $logger
    ) {}

    /**
     * Validiert einen Kurs, falls er externe Validierung erfordert.
     *
     * @throws AccessDeniedException
     */
    public function validateAction(int $courseInstanceId): void
    {
        $frontendUser = $this->getFrontendUser();
        $userId = $frontendUser?->user['uid'] ?? null;

        if (!$this->userIsCertifier()) {
            throw new AccessDeniedException('Zugriff verweigert: Nur Certifier dürfen validieren.');
        }

        $course = $this->courseInstanceRepository->findByUid($courseInstanceId);

        if (!$course instanceof CourseInstance) {
            $this->addFlashMessage('Kurs nicht gefunden.', 'Fehler', AbstractMessage::ERROR);
            $this->redirect('list', 'CourseInstance');
            return;
        }

        if (!$course->getRequiresExternalValidation()) {
            $this->addFlashMessage(
                LocalizationUtility::translate('course_no_validation_needed', 'equed_lms')
                    ?? 'Dieser Kurs benötigt keine externe Validierung.',
                '',
                AbstractMessage::INFO
            );
            $this->redirect('show', 'CourseInstance', null, ['courseInstance' => $course->getUid()]);
            return;
        }

        // Markiere Kurs als validiert
        $course->setStatus('validated');
        $this->courseInstanceRepository->update($course);

        $this->addFlashMessage(
            LocalizationUtility::translate('course_validated', 'equed_lms')
                ?? 'Kurs erfolgreich validiert.',
            '',
            AbstractMessage::OK
        );

        $this->logger->info('CourseInstance validated by Certifier', [
            'courseInstanceId' => $course->getUid(),
            'certifierId' => $userId,
        ]);

        $this->redirect('show', 'CourseInstance', null, ['courseInstance' => $course->getUid()]);
    }

    /**
     * Zugriff nur für Benutzer mit Rolle „Certifier“ erlaubt.
     */
    protected function userIsCertifier(): bool
    {
        $user = $this->getFrontendUser();
        return isset($user->user['usergroup']) && is_array($user->groupData['uid']) && in_array('CERTIFIER_GROUP_UID', $user->groupData['uid']);
        // TODO: Ersetze 'CERTIFIER_GROUP_UID' durch echte FE-Usergroup UID der Certifier
    }

    /**
     * Gibt das aktuelle FE-User-Objekt zurück.
     */
    protected function getFrontendUser(): ?FrontendUserAuthentication
    {
        return $GLOBALS['TSFE']->fe_user ?? null;
    }
}