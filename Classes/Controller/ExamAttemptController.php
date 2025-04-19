<?php
declare(strict_types=1);

namespace Equed\EquedLms\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\View\JsonView;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use Equed\EquedLms\Domain\Model\ExamAttempt;
use Equed\EquedLms\Domain\Repository\ExamAttemptRepository;
use Equed\EquedLms\Domain\Model\FrontendUser;

class ExamAttemptController extends ActionController
{
    protected ExamAttemptRepository $examAttemptRepository;
    protected PersistenceManager $persistenceManager;

    public function __construct(
        ExamAttemptRepository $examAttemptRepository,
        PersistenceManager $persistenceManager
    ) {
        $this->examAttemptRepository = $examAttemptRepository;
        $this->persistenceManager = $persistenceManager;
    }

    /**
     * Starte neuen Prüfungsversuch
     */
    public function startAction(array $data): ResponseInterface
    {
        $attempt = GeneralUtility::makeInstance(ExamAttempt::class);
        $attempt->setUser($this->getCurrentUser());
        $attempt->setCourseInstanceUid((int)$data['courseInstanceUid']);
        $attempt->setType($data['type'] ?? 'theory');
        $attempt->setStartedAt(new \DateTime());
        $attempt->setStatus('in_progress');

        $this->examAttemptRepository->add($attempt);
        $this->persistenceManager->persistAll();

        return $this->jsonResponse(['success' => true, 'attemptId' => $attempt->getUid()]);
    }

    /**
     * Prüfungsversuch abschließen
     */
    public function finishAction(int $attemptId, array $resultData): ResponseInterface
    {
        $attempt = $this->examAttemptRepository->findByIdentifier($attemptId);

        if (!$attempt) {
            return $this->jsonResponse(['error' => 'Attempt not found'], 404);
        }

        $attempt->setScore((float)($resultData['score'] ?? 0));
        $attempt->setPassed((bool)($resultData['passed'] ?? false));
        $attempt->setStatus('submitted');
        $attempt->setSubmittedAt(new \DateTime());

        $this->examAttemptRepository->update($attempt);
        $this->persistenceManager->persistAll();

        return $this->jsonResponse(['success' => true]);
    }

    /**
     * Instructor bewertet Prüfungsversuch
     */
    public function evaluateAction(int $attemptId, array $evaluationData): ResponseInterface
    {
        $attempt = $this->examAttemptRepository->findByIdentifier($attemptId);

        if (!$attempt) {
            return $this->jsonResponse(['error' => 'Attempt not found'], 404);
        }

        $attempt->setStatus('reviewed');
        $attempt->setReviewedBy($this->getCurrentUser());
        $attempt->setReviewedAt(new \DateTime());
        $attempt->setComment($evaluationData['comment'] ?? '');
        $attempt->setDocumentUrl($evaluationData['documentUrl'] ?? '');

        $this->examAttemptRepository->update($attempt);
        $this->persistenceManager->persistAll();

        return $this->jsonResponse(['success' => true]);
    }

    /**
     * Einzelnen Versuch anzeigen
     */
    public function showAction(int $attemptId): ResponseInterface
    {
        $attempt = $this->examAttemptRepository->findByIdentifier($attemptId);
        return $attempt ? $this->jsonResponse($attempt) : $this->jsonResponse(['error' => 'Not found'], 404);
    }

    /**
     * JSON-Antwort für SPA/API
     */
    protected function jsonResponse($data, int $status = 200): ResponseInterface
    {
        $view = GeneralUtility::makeInstance(JsonView::class);
        $view->assign('value', $data);
        $response = $this->responseFactory->createResponse($status);
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    }

    /**
     * Aktuell eingeloggter User (Teilnehmend oder Instructor)
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

