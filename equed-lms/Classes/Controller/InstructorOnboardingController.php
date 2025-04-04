<?php
declare(strict_types=1);

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Annotation\Inject;
use Equed\EquedLms\Domain\Repository\InstructorRepository;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Utility\GeneralUtility;

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
        $userId = $context->getPropertyFromAspect('frontend.user', 'id');

        if (!$userId) {
            $this->redirect('login', 'Auth');
        }

        $instructor = $this->instructorRepository->findByUid((int)$userId);

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
        $userId = $context->getPropertyFromAspect('frontend.user', 'id');

        if (!$userId) {
            $this->redirect('login', 'Auth');
        }

        $instructor = $this->instructorRepository->findByUid((int)$userId);

        if (!$instructor || !$instructor->isInstructor()) {
            $this->redirect('accessDenied', 'Error');
        }

        $onboardingStatus = $instructor->getOnboardingStatus();
        $onboardingStatus->setComplete(true);
        $this->instructorRepository->update($instructor);

        $this->addFlashMessage('Das Onboarding wurde erfolgreich abgeschlossen.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);

        $this->redirect('dashboard', 'Instructor');
    }
}