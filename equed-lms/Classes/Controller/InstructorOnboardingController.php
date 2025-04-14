<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Repository\InstructorRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Exception\AccessDeniedException;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ResponseInterface;

class InstructorOnboardingController extends ActionController
{
    public function __construct(
        protected readonly InstructorRepository $instructorRepository,
        protected readonly LoggerInterface $logger
    ) {}

    /**
     * Shows onboarding status for the logged-in instructor.
     *
     * @throws AccessDeniedException
     */
    public function indexAction(): ResponseInterface
    {
        $userId = $this->getUserId();
        $instructor = $this->instructorRepository->findByUid($userId);

        if (!$instructor || !$instructor->isInstructor()) {
            $this->logger->warning('Unauthorized onboarding access attempt.', ['userId' => $userId]);
            return $this->redirect('accessDenied', 'Error');
        }

        $status = $instructor->getOnboardingStatus();

        $this->view->assign('onboardingData', [
            'steps' => $status->getSteps(),
            'completed' => $status->isComplete(),
        ]);

        $this->logger->info('Instructor onboarding page accessed.', ['userId' => $userId]);
        return $this->htmlResponse();
    }

    /**
     * Marks the onboarding as complete.
     */
    public function completeAction(): ResponseInterface
    {
        $userId = $this->getUserId();
        $instructor = $this->instructorRepository->findByUid($userId);

        if (!$instructor || !$instructor->isInstructor()) {
            $this->logger->warning('Onboarding completion denied.', ['userId' => $userId]);
            return $this->redirect('accessDenied', 'Error');
        }

        $instructor->getOnboardingStatus()?->setComplete(true);
        $this->instructorRepository->update($instructor);

        $this->addFlashMessage(
            LocalizationUtility::translate('onboarding.complete.message', 'EquedLms') ?? 'Onboarding completed.',
            '',
            AbstractMessage::OK
        );

        $this->logger->info('Instructor onboarding completed.', ['userId' => $userId]);
        return $this->redirect('dashboard', 'Instructor');
    }

    /**
     * Returns the currently logged-in frontend user ID.
     */
    protected function getUserId(): int
    {
        $context = GeneralUtility::makeInstance(Context::class);
        return (int)($context->getPropertyFromAspect('frontend.user', 'id') ?? 0);
    }
}
