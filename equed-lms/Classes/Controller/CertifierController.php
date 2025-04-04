<?php

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Equed\EquedLms\Domain\Repository\UserCourseRecordRepository;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Extbase\Annotation\Inject;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;

class CertifierController extends ActionController
{
    #[Inject]
    protected UserCourseRecordRepository $userCourseRecordRepository;

    #[Inject]
    protected PersistenceManager $persistenceManager;

    protected function initializeView(ViewInterface $view): void
    {
        parent::initializeView($view);
        // Prüfen, ob eingeloggter User ein Certifier ist (vereinfachter Platzhalter)
        $feUser = $GLOBALS['TSFE']->fe_user->user ?? null;
        if (!$feUser || ($feUser['usergroup'] ?? '') !== 'certifier') {
            $this->addFlashMessage('Kein Zugriff – nur für Certifier sichtbar.', '', 
                \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
            $this->redirect('index', 'Dashboard');
        }
    }

    public function indexAction(): void
    {
        $pendingRecords = $this->userCourseRecordRepository->findPendingValidations();
        $this->view->assignMultiple([
            'pendingRecords' => $pendingRecords,
        ]);
    }

    public function validateAction(int $courseRecordId, bool $isValid): void
    {
        $record = $this->userCourseRecordRepository->findByUid($courseRecordId);

        if (!$record) {
            $this->addFlashMessage('Kursdatensatz nicht gefunden.', '', 
                \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
            $this->redirect('index');
            return;
        }

        if ($isValid) {
            $record->setValidationStatus('valid');
            $record->setValidatedAt(new \DateTimeImmutable());
            $record->setValidatedBy($GLOBALS['TSFE']->fe_user->user['uid'] ?? 0);
            $this->addFlashMessage('Zertifizierung erfolgreich bestätigt.');
        } else {
            $record->setValidationStatus('rejected');
            $this->addFlashMessage('Zertifizierung wurde abgelehnt.', '', 
                \TYPO3\CMS\Core\Messaging\FlashMessage::WARNING);
        }

        $this->userCourseRecordRepository->update($record);
        $this->persistenceManager->persistAll();

        // (Optional: Trigger für Zertifikat oder Benachrichtigung hier einfügen)

        $this->redirect('index');
    }
}