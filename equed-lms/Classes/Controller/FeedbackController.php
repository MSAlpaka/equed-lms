<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Model\Feedback;
use EquedLms\Domain\Repository\FeedbackRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class FeedbackController extends ActionController
{
    protected FeedbackRepository $feedbackRepository;

    public function __construct(FeedbackRepository $feedbackRepository)
    {
        $this->feedbackRepository = $feedbackRepository;
    }

    /**
     * Zeigt alle Feedbacks zu einem bestimmten Kurs an
     */
    public function listAction(int $courseId): void
    {
        $feedbacks = $this->feedbackRepository->findByCourseId($courseId);
        $this->view->assign('feedbacks', $feedbacks);
    }

    /**
     * Zeigt ein bestimmtes Feedback an
     */
    public function showAction(Feedback $feedback): void
    {
        $this->view->assign('feedback', $feedback);
    }

    /**
     * Erstellt neues Feedback für einen Kurs
     */
    public function createAction(int $courseId, string $message): void
    {
        $feedback = new Feedback();
        $feedback->setCourseId($courseId);
        $feedback->setUserId($this->getFrontendUserId()); // Holt die ID des eingeloggten Benutzers
        $feedback->setMessage($message);
        $this->feedbackRepository->add($feedback);
        $this->redirect('list', null, null, ['courseId' => $courseId]);
    }

    /**
     * Löscht ein Feedback
     */
    public function deleteAction(Feedback $feedback): void
    {
        $this->feedbackRepository->remove($feedback);
        $this->redirect('list', null, null, ['courseId' => $feedback->getCourseId()]);
    }

    /**
     * Holt die Benutzer-ID des eingeloggten Nutzers
     */
    protected function getFrontendUserId(): int
    {
        return (int)GeneralUtility::makeInstance(Context::class)->getPropertyFromAspect('frontend.user', 'id');
    }
}