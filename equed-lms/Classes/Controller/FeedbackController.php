<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Model\Feedback;
use EquedLms\Domain\Repository\FeedbackRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ResponseInterface;

class FeedbackController extends ActionController
{
    public function __construct(
        protected readonly FeedbackRepository $feedbackRepository,
        protected readonly LoggerInterface $logger
    ) {}

    /**
     * Lists all feedback for a given course.
     */
    public function listAction(int $courseId): ResponseInterface
    {
        $feedbacks = $this->feedbackRepository->findByCourseId($courseId);
        $this->view->assign('feedbacks', $feedbacks);

        $this->logger->info('Feedback list displayed', ['courseId' => $courseId, 'count' => count($feedbacks)]);
        return $this->htmlResponse();
    }

    /**
     * Displays a single feedback item.
     */
    public function showAction(Feedback $feedback): ResponseInterface
    {
        $this->view->assign('feedback', $feedback);

        $this->logger->info('Feedback shown', ['id' => $feedback->getUid()]);
        return $this->htmlResponse();
    }

    /**
     * Creates new feedback for a course.
     */
    public function createAction(int $courseId, string $message): void
    {
        $feedback = new Feedback();
        $feedback->setCourseId($courseId);
        $feedback->setUserId($this->getFrontendUserId());
        $feedback->setMessage($message);

        $this->feedbackRepository->add($feedback);

        $this->logger->info('Feedback created', ['courseId' => $courseId, 'userId' => $feedback->getUserId()]);
        $this->addFlashMessage(
            LocalizationUtility::translate('flashMessages.feedbackCreated', 'EquedLms')
                ?? 'Feedback submitted successfully.',
            '',
            AbstractMessage::OK
        );

        $this->redirect('list', null, null, ['courseId' => $courseId]);
    }

    /**
     * Deletes a feedback item.
     */
    public function deleteAction(Feedback $feedback): void
    {
        $this->feedbackRepository->remove($feedback);

        $this->logger->warning('Feedback deleted', ['id' => $feedback->getUid()]);
        $this->addFlashMessage(
            LocalizationUtility::translate('flashMessages.feedbackDeleted', 'EquedLms')
                ?? 'Feedback deleted.',
            '',
            AbstractMessage::WARNING
        );

        $this->redirect('list', null, null, ['courseId' => $feedback->getCourseId()]);
    }

    /**
     * Returns the ID of the currently logged-in frontend user.
     */
    protected function getFrontendUserId(): int
    {
        $context = GeneralUtility::makeInstance(Context::class);
        return (int)($context->getPropertyFromAspect('frontend.user', 'id') ?? 0);
    }
}