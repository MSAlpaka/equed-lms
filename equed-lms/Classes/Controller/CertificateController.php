<?php

declare(strict_types=1);

namespace Equed\EquedLms\Controller;

use Equed\EquedLms\Domain\Model\Certificate;
use Equed\EquedLms\Domain\Model\UserCourseRecord;
use Equed\EquedLms\Domain\Repository\CertificateRepository;
use Equed\EquedLms\Domain\Repository\UserCourseRecordRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class CertificateController extends ActionController
{
    protected UserCourseRecordRepository $recordRepository;
    protected CertificateRepository $certificateRepository;

    public function __construct(
        UserCourseRecordRepository $recordRepository,
        CertificateRepository $certificateRepository
    ) {
        $this->recordRepository = $recordRepository;
        $this->certificateRepository = $certificateRepository;
    }

    /**
     * Zeigt die Zertifikatskarte zum Kursabschluss an
     */
    public function showCardAction(UserCourseRecord $record): void
    {
        $certificate = $this->certificateRepository->findByUserCourseRecord($record);

        // Falls kein Zertifikat existiert, Dummy-Objekt erstellen für Vorschau
        if (!$certificate) {
            $certificate = new Certificate();
            $certificate->setCode($record->getCertificateCode());
            $certificate->setUserCourseRecord($record);
            $certificate->setIssuedAt($record->getCompletionDate());
            $certificate->setIssuedBy($record->getInstructor());
        }

        $this->view->assignMultiple([
            'certificate' => $certificate,
            'record' => $record,
        ]);
    }

    // Optional: PDF-Download folgt später als eigene Action
}