<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Model\CourseInstance;
use EquedLms\Domain\Repository\CourseInstanceRepository;
use EquedLms\Domain\Repository\CourseProgramRepository;
use EquedLms\Domain\Repository\CenterRepository;
use EquedLms\Domain\Repository\FrontendUserRepository;
use EquedLms\Service\CertificateService;
use Psr\Log\LoggerInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Exception\AccessDeniedException;
use EquedLms\Domain\Model\UserCourseRecord;

class CourseInstanceController extends ActionController
{
    public function __construct(
        protected readonly CourseInstanceRepository $courseInstanceRepository,
        protected readonly CourseProgramRepository $courseProgramRepository,
        protected readonly CenterRepository $centerRepository,
        protected readonly FrontendUserRepository $frontendUserRepository,
        protected readonly CertificateService $certificateService,
        protected readonly LoggerInterface $logger
    ) {}

    /**
     * Zeigt alle Kursdurchführungen an.
     */
    public function listAction(): void
    {
        $instances = $this->courseInstanceRepository->findAll();
        $this->view->assign('courseInstances', $instances);

        $this->logger->info('Kursdurchführungen angezeigt', ['count' => count($instances)]);
    }

    /**
     * Zeigt eine Kursdurchführung im Detail.
     */
    public function showAction(CourseInstance $courseInstance): void
    {
        $this->view->assign('courseInstance', $courseInstance);
        $this->logger->info('Kursdurchführung angezeigt', ['uid' => $courseInstance->getUid()]);
    }

    /**
     * Zeigt das Formular für die Erstellung einer neuen Kursdurchführung.
     */
    public function newAction(): void
    {
        $this->checkAccess();
        $this->view->assignMultiple([
            'coursePrograms' => $this->courseProgramRepository->findAll(),
            'centers' => $this->centerRepository->findAll(),
            'instructors' => $this->frontendUserRepository->findAllInstructors()
        ]);
    }

    /**
     * Erstellt eine neue Kursdurchführung.
     */
    public function createAction(CourseInstance $courseInstance): void
    {
        $this->checkAccess();
        
        $this->courseInstanceRepository->add($courseInstance);
        $this->logger->info('Kursdurchführung erstellt', ['id' => $courseInstance->getUid()]);

        $this->addFlashMessage(
            LocalizationUtility::translate('flashMessages.courseInstanceCreated', 'EquedLms') ?? 'Kursdurchführung erfolgreich erstellt.',
            '',
            AbstractMessage::OK
        );

        $this->redirect('list');
    }

    /**
     * Zeigt das Bearbeitungsformular für eine Kursdurchführung.
     */
    public function editAction(CourseInstance $courseInstance): void
    {
        $this->checkAccess();
        $this->view->assignMultiple([
            'courseInstance' => $courseInstance,
            'coursePrograms' => $this->courseProgramRepository->findAll(),
            'centers' => $this->centerRepository->findAll(),
            'instructors' => $this->frontendUserRepository->findAllInstructors()
        ]);
    }

    /**
     * Aktualisiert eine bestehende Kursdurchführung.
     */
    public function updateAction(CourseInstance $courseInstance): void
    {
        $this->checkAccess();

        $this->courseInstanceRepository->update($courseInstance);
        $this->logger->info('Kursdurchführung aktualisiert', ['id' => $courseInstance->getUid()]);

        $this->addFlashMessage(
            LocalizationUtility::translate('flashMessages.courseInstanceUpdated', 'EquedLms') ?? 'Kursdurchführung erfolgreich aktualisiert.',
            '',
            AbstractMessage::OK
        );

        $this->redirect('list');
    }

    /**
     * Abschlussvalidierung: Nur wenn alle Prüfungen bestanden wurden, wird der Kurs als abgeschlossen markiert und das Zertifikat generiert.
     */
    public function completeCourseAction(UserCourseRecord $userCourseRecord): void
    {
        $courseInstance = $userCourseRecord->getCourseInstance();

        // Alle Prüfungen durchlaufen und den Status überprüfen
        $allExamsPassed = true;
        foreach ($courseInstance->getExams() as $exam) {
            if ($exam->getStatus() !== 'Passed') {
                $allExamsPassed = false;
                break;
            }
        }

        if ($allExamsPassed) {
            // Kurs als abgeschlossen markieren und Zertifikat generieren
            $certificate = $this->certificateService->generateCertificate($userCourseRecord);
            $this->sendCertificate($certificate);

            // Bestätigung im Frontend
            $this->addFlashMessage('Kurs erfolgreich abgeschlossen. Zertifikat wurde erstellt.');
        } else {
            // Rückmeldung, wenn Prüfungen nicht bestanden wurden
            $this->addFlashMessage('Du hast nicht alle Prüfungen bestanden. Bitte versuche es erneut.');
        }

        // Weiterleitung oder Anzeige der Kursinstanz
        $this->redirect('show', null, null, ['courseInstance' => $courseInstance]);
    }

    /**
     * Sendet das Zertifikat an den Teilnehmer (per E-Mail oder als Download-Link im Frontend).
     */
    protected function sendCertificate($certificate): void
    {
        // E-Mail-Benachrichtigung oder Speicherung des Zertifikats
        $this->sendEmailNotification($certificate);
    }

    /**
     * Benachrichtigt den Teilnehmer per E-Mail, dass das Zertifikat erstellt wurde.
     */
    protected function sendEmailNotification($certificate): void
    {
        $recipient = $certificate->getUser()->getEmail();
        $subject = 'Ihr Kursabschluss-Zertifikat';
        $body = 'Herzlichen Glückwunsch! Ihr Kursabschlusszertifikat wurde erstellt. Sie können es hier herunterladen: [Link].';

        // E-Mail-Versandlogik hier
    }

    /**
     * Zugriffsschutz: Nur Admins dürfen Kursdurchführungen erstellen und bearbeiten.
     *
     * @throws AccessDeniedException
     */
    protected function checkAccess(): void
    {
        $user = $this->getFrontendUser();
        if (!$user || !$user->getGroups()->contains(1)) {  // 1 ist die ID der Admin-Gruppe
            throw new AccessDeniedException('Zugriff verweigert: Nur Administratoren haben Zugriff auf diese Funktion.');
        }
    }

    /**
     * Gibt den aktuellen Frontend-User zurück.
     */
    protected function getFrontendUser(): ?\TYPO3\CMS\Extbase\Domain\Model\FrontendUser
    {
        return $GLOBALS['TSFE']->fe_user->user;
    }
}