<?php
declare(strict_types=1);

namespace Equed\EquedLms\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\View\JsonView;
use TYPO3\CMS\Extbase\Annotation\Inject;
use Equed\EquedLms\Domain\Repository\UserSubmissionRepository;
use Equed\EquedLms\Domain\Repository\InstructorFeedbackRepository;
use Equed\EquedLms\Domain\Model\UserSubmission;
use Equed\EquedLms\Domain\Model\InstructorFeedback;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;

class SubmissionController extends ActionController
{
    /**
     * @var UserSubmissionRepository
     */
    protected UserSubmissionRepository $submissionRepository;

    /**
     * @var InstructorFeedbackRepository
     */
    protected InstructorFeedbackRepository $feedbackRepository;

    /**
     * @var PersistenceManager
     */
    protected PersistenceManager $persistenceManager;

    public function __construct(
        UserSubmissionRepository $submissionRepository,
        InstructorFeedbackRepository $feedbackRepository,
        PersistenceManager $persistenceManager
    ) {
        $this->submissionRepository = $submissionRepository;
        $this->feedbackRepository = $feedbackRepository;
        $this->persistenceManager = $persistenceManager;
    }

    /**
     * Gibt alle Abgaben einer bestimmten Kursinstanz aus (Instructor-Zugriff)
     */
    public function listForCourseInstanceAction(int $courseInstanceId): ResponseInterface
    {
        $submissions = $this->submissionRepository->findByCourseInstance($courseInstanceId);
        return $this->jsonResponse($submissions);
    }

    /**
     * Einzelne Abgabe anzeigen
     */
    public function showAction(int $submissionId): ResponseInterface
    {
        $submission = $this->submissionRepository->findByIdentifier($submissionId);
        return $this->jsonResponse($submission);
    }

    /**
     * Neue Abgabe speichern (von Teilnehmenden)
     */
    public function createAction(array $data): ResponseInterface
    {
        $submission = GeneralUtility::makeInstance(UserSubmission::class);
        $submission->setUser($this->getCurrentUser());
        $submission->setTitle($data['title'] ?? '');
        $submission->setSubmissionType($data['submissionType'] ?? 'text');
        $submission->setTextContent($data['textContent'] ?? '');
        $submission->setExternalUrl($data['externalUrl'] ?? '');
        $submission->setStatus('submitted');
        $submission->setSubmittedAt(new \DateTime());

        $this->submissionRepository->add($submission);
        $this->persistenceManager->persistAll();

        return $this->jsonResponse(['success' => true, 'submissionId' => $submission->getUid()]);
    }

    /**
     * Feedback von Instructor speichern
     */
    public function submitFeedbackAction(int $submissionId, array $feedbackData): ResponseInterface
    {
        $submission = $this->submissionRepository->findByIdentifier($submissionId);

        if (!$submission) {
            return $this->jsonResponse(['error' => 'Submission not found'], 404);
        }

        $feedback = GeneralUtility::makeInstance(InstructorFeedback::class);
        $feedback->setInstructor($this->getCurrentUser());
        $feedback->setComment($feedbackData['comment'] ?? '');
        $feedback->setRating((int)($feedbackData['rating'] ?? 0));
        $feedback->setCreatedAt(new \DateTime());

        $this->feedbackRepository->add($feedback);
        $submission->setFeedback($feedback);
        $submission->setStatus($feedbackData['status'] ?? 'in_review');

        $this->submissionRepository->update($submission);
        $this->persistenceManager->persistAll();

        return $this->jsonResponse(['success' => true]);
    }

    /**
     * Hilfsfunktion für JSON-Antwort
     */
    protected function jsonResponse($data, int $status = 200): ResponseInterface
    {
        /** @var JsonView $view */
        $view = GeneralUtility::makeInstance(JsonView::class);
        $view->assign('value', $data);
        $response = $this->responseFactory->createResponse($status);
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    }

    /**
     * Aktuell eingeloggter FE-User
     */
    protected function getCurrentUser(): ?FrontendUser
    {
        return $GLOBALS['TSFE']->fe_user->user['uid']
            ? $this->objectManager->get(\Equed\EquedLms\Domain\Repository\FrontendUserRepository::class)->findByUid(
                (int)$GLOBALS['TSFE']->fe_user->user['uid']
            )
            : null;
    }
}

