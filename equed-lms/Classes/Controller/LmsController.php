<?php

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Http\RedirectResponse;
use TYPO3\CMS\Core\Http\ResponseInterface;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use Equed\EquedLms\Domain\Repository\CourseRepository;
use Equed\EquedLms\Domain\Repository\CenterRepository;
use Equed\EquedLms\Domain\Repository\LessonRepository;
use Equed\EquedLms\Domain\Repository\ContentPageRepository;
use Equed\EquedLms\Domain\Repository\QuizQuestionRepository;
use Equed\EquedLms\Domain\Repository\UserLessonProgressRepository;
use Equed\EquedLms\Domain\Repository\AuditLogRepository;
use Equed\EquedLms\Domain\Repository\UserSubmissionRepository;

class LmsController extends ActionController
{
    public function __construct(
        protected CourseRepository $courseRepository,
        protected CenterRepository $centerRepository,
        protected LessonRepository $lessonRepository,
        protected ContentPageRepository $contentPageRepository,
        protected QuizQuestionRepository $quizQuestionRepository,
        protected UserLessonProgressRepository $userLessonProgressRepository,
        protected AuditLogRepository $auditLogRepository,
        protected UserSubmissionRepository $userSubmissionRepository
    ) {}

    // ... andere Actions bleiben gleich ...

    public function certificateAction(int $courseId): ResponseInterface
    {
        $userId = $GLOBALS['TSFE']->fe_user['uid'] ?? 0;
        if ($userId === 0) {
            return new RedirectResponse('/login');
        }

        $course = $this->courseRepository->findByIdentifier($courseId);

        if (!$course->isCertificateAvailable()) {
            $this->addFlashMessage('Für diesen Kurs wird kein Zertifikat ausgestellt.', '', AbstractMessage::WARNING);
            return $this->redirect('dashboard');
        }

        $lessons = $course->getLessons();
        $progress = $this->userLessonProgressRepository->findByFeUser($userId);
        $total = count($lessons);
        $completed = 0;
        $latestDate = 0;

        foreach ($lessons as $lesson) {
            $lessonId = $lesson->getUid();
            if (!empty($progress[$lessonId]) && $progress[$lessonId]->isCompleted()) {
                if ($progress[$lessonId]->getFeUser() !== $userId) {
                    $this->addFlashMessage('Unberechtigter Zugriff auf ein fremdes Zertifikat.', '', AbstractMessage::ERROR);
                    return $this->redirect('dashboard');
                }
                $completed++;
                $latestDate = max($latestDate, $progress[$lessonId]->getCompletedAt());
            }
        }

        if ($course->isRequireTheory() && ($total === 0 || $completed !== $total)) {
            $this->addFlashMessage('Die theoretischen Voraussetzungen sind noch nicht vollständig erfüllt.', '', AbstractMessage::WARNING);
            return $this->redirect('dashboard');
        }

        if ($course->isRequirePractice()) {
            $practiceSubmissions = $this->userSubmissionRepository->findByUserAndCourse($userId, $courseId);
            $hasPractice = false;
            foreach ($practiceSubmissions as $sub) {
                if ($sub->getType() === 'practiceExam' && $sub->getStatus() === 'approved') {
                    $hasPractice = true;
                    break;
                }
            }
            if (!$hasPractice) {
                $this->addFlashMessage('Die praktische Prüfung wurde noch nicht genehmigt.', '', AbstractMessage::WARNING);
                return $this->redirect('dashboard');
            }
        }

        if ($course->isRequireCaseStudy()) {
            $caseSubmissions = $this->userSubmissionRepository->findByUserAndCourse($userId, $courseId);
            $hasCase = false;
            foreach ($caseSubmissions as $sub) {
                if ($sub->getType() === 'caseStudy' && $sub->getStatus() === 'approved') {
                    $hasCase = true;
                    break;
                }
            }
            if (!$hasCase) {
                $this->addFlashMessage('Die Fallarbeit wurde noch nicht genehmigt.', '', AbstractMessage::WARNING);
                return $this->redirect('dashboard');
            }
        }

        $this->auditLogRepository->log($userId, 'certificate.issued', 'course', $courseId);

        $center = $course->getCenter();
        $user = $GLOBALS['TSFE']->fe_user['user'];

        $this->view->assignMultiple([
            'participantName' => $user['name'] ?? ($user['first_name'] . ' ' . $user['last_name']),
            'participantId' => $userId,
            'courseTitle' => $course->getTitle(),
            'completionDate' => $latestDate ? date('Y-m-d', $latestDate) : date('Y-m-d'),
            'centerName' => $center?->getName(),
            'centerStreet' => $center?->getStreet(),
            'centerZip' => $center?->getZip(),
            'centerCity' => $center?->getCity(),
            'centerWebsite' => $center?->getWebsite(),
            'centerId' => $center?->getCenterId(),
            'centerLogo' => $center?->getLogo()
        ]);

        return $this->htmlResponse();
    }
}