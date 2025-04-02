<?php

declare(strict_types=1);

namespace Equed\EquedLms\Controller;

use Equed\EquedLms\Domain\Model\UserCourseRecord;
use Equed\EquedLms\Domain\Repository\UserCourseRecordRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class VerifyController extends ActionController
{
    protected UserCourseRecordRepository $recordRepository;

    public function __construct(UserCourseRecordRepository $recordRepository)
    {
        $this->recordRepository = $recordRepository;
    }

    /**
     * Action zur Anzeige des Zertifikatsstatus
     * 
     * @param string $certificateCode Der Code des Zertifikats, das überprüft werden soll
     */
    public function showAction(string $certificateCode): void
    {
        // Zertifikatsdaten anhand des Codes suchen
        $record = $this->recordRepository->findOneByCertificateCode($certificateCode);

        // Überprüfen, ob das Zertifikat existiert und validiert ist
        if (!$record || !$record->isValidated()) {
            $this->addFlashMessage('Certificate not found or invalid.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
            $this->redirect('index', 'Home');
        }

        // Zertifikatsdaten an das View übergeben
        $this->view->assignMultiple([
            'user' => $record->getUser(),
            'course' => $record->getCourse(),
            'certifier' => $record->getValidatedBy(),
            'center' => $record->getCenter(),
            'certificate' => [
                'code' => $certificateCode,
                'status' => $record->isValidated() ? 'Valid' : 'Invalid',
                'completionDate' => $record->getCompletionDate(),
            ]
        ]);
    }
}