<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Annotation\Inject;
use EquedLms\Domain\Repository\InstructorRepository;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Exception\AccessDeniedException;

class InstructorOnboardingController extends ActionController
{
    #[Inject]
    protected InstructorRepository $instructorRepository;

    /**
     * Zeigt den aktuellen Stand des Onboardings für eingeloggte Instructoren an.
     */
    public function indexAction(): void
    {
        $context = GeneralUtility::makeInstance(Context::class);
        $userId = (int)$context->getPropertyFromAspect('frontend.user', 'id');

        if (!$userId) {
            $this->redirect('login', 'Auth');
        }

        $instructor = $this->instructorRepository->findByUid($userId);

        if (!$instructor || !$instructor->isInstructor()) {
            $this->redirect('accessDenied', 'Error');
        }

        $onboardingStatus = $instructor->getOnboardingStatus();
        $this->view->assign('onboardingData', [
            'steps' => $onboardingStatus->getSteps(),
            'completed' => $onboardingStatus->isComplete(),
        ]);
    }

    /**
     * Schließt den Onboarding-Prozess ab.
     */
    public function completeAction(): void
    {
        $context = GeneralUtility::makeInstance(Context::class);
        $userId = (int)$context->getPropertyFromAspect('frontend.user', 'id');

        if (!$userId) {
            $this->redirect('login', 'Auth');
        }

        $instructor = $this->instructorRepository->findByUid($userId);

        if (!$instructor || !$instructor->isInstructor()) {
            $this->redirect('accessDenied', 'Error');
        }

        $onboardingStatus = $instructor->getOnboardingStatus();
        $onboardingStatus->setComplete(true);
        $this->instructorRepository->update($instructor);

        $this->addFlashMessage(
            $this->translate('onboarding.complete.message'),
            '',
            \TYPO3\CMS\Core\Messaging\AbstractMessage::OK
        );

        $this->redirect('dashboard', 'Instructor');
    }
}