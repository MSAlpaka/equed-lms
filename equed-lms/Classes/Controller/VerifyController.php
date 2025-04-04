<?php

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Equed\EquedLms\Domain\Repository\UserCourseRecordRepository;
use Equed\EquedLms\Service\VerificationService;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class VerifyController extends ActionController
{
    protected UserCourseRecordRepository $userCourseRecordRepository;
    protected VerificationService $verificationService;

    public function __construct(
        UserCourseRecordRepository $userCourseRecordRepository,
        VerificationService $verificationService
    ) {
        $this->userCourseRecordRepository = $userCourseRecordRepository;
        $this->verificationService = $verificationService;
    }

    /**
     * Verify user data or course completion
     */
    public function indexAction(int $userId = 0, int $courseId = 0): void
    {
        if ($userId === 0 || $courseId === 0) {
            $this->addFlashMessage(
                $this->translate('verify.error.missingParameters'),
                '',
                \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR
            );
            $this->redirect('error');
        }

        $userCourseRecord = $this->userCourseRecordRepository->findOneByUserAndCourse($userId, $courseId);

        if (!$userCourseRecord) {
            $this->addFlashMessage(
                $this->translate('verify.error.noRecordFound'),
                '',
                \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR
            );
            $this->redirect('error');
        }

        $verificationStatus = $this->verificationService->verifyCourseCompletion($userCourseRecord);

        $this->view->assignMultiple([
            'userCourseRecord' => $userCourseRecord,
            'verificationStatus' => $verificationStatus
        ]);
    }

    /**
     * Translate labels
     */
    protected function translate(string $key, array $arguments = []): string
    {
        return $this->translator->translate(
            $key,
            'equedlms',
            $arguments
        );
    }

    public function errorAction(): void
    {
        // Zeigt eine Standard-Fehlerseite an
    }
}