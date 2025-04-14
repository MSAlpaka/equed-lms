<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use EquedLms\Domain\Repository\CourseInstanceRepository;
use EquedLms\Domain\Repository\UserCourseRecordRepository;
use EquedLms\Domain\Model\UserCourseRecord;

class InstructorDashboardController extends ActionController
{
    public function __construct(
        protected readonly CourseInstanceRepository $courseInstanceRepository,
        protected readonly UserCourseRecordRepository $userCourseRecordRepository,
        protected readonly LoggerInterface $logger
    ) {}

    public function indexAction(): ResponseInterface
    {
        $user = $this->getAuthenticatedUser();
        $assignedInstances = $this->courseInstanceRepository->findByInstructor($user);

        $this->view->assignMultiple([
            'user' => $user,
            'courseInstances' => $assignedInstances,
        ]);

        return $this->htmlResponse();
    }

    public function showParticipantsAction(int $courseInstanceId): ResponseInterface
    {
        $user = $this->getAuthenticatedUser();
        $instance = $this->courseInstanceRepository->findByUid($courseInstanceId);

        if (!$instance || !$this->isInstructorOf($user, $instance)) {
            $this->addFlashMessage(
                LocalizationUtility::translate('error_not_authorized', 'equed_lms') ?? 'Access denied.',
                '',
                AbstractMessage::ERROR
            );
            return $this->redirect('index');
        }

        $records = $this->userCourseRecordRepository->findByCourseInstance($instance);

        $this->view->assignMultiple([
            'courseInstance' => $instance,
            'records' => $records
        ]);

        return $this->htmlResponse();
    }

    public function confirmCompletionAction(int $recordId): ResponseInterface
    {
        $user = $this->getAuthenticatedUser();
        $record = $this->userCourseRecordRepository->findByUid($recordId);

        if (!$record || !$this->isInstructorOf($user, $record->getCourseInstance())) {
            $this->addFlashMessage(
                LocalizationUtility::translate('error_not_authorized', 'equed_lms') ?? 'Access denied.',
                '',
                AbstractMessage::ERROR
            );
            return $this->redirect('index');
        }

        $record->setInstructorConfirmed(true);
        $this->userCourseRecordRepository->update($record);

        $this->addFlashMessage(
            LocalizationUtility::translate('completion_confirmed', 'equed_lms') ?? 'Course marked as complete.',
            '',
            AbstractMessage::OK
        );

        return $this->redirect('showParticipants', null, null, ['courseInstanceId' => $record->getCourseInstance()->getUid()]);
    }

    private function getAuthenticatedUser(): ?\TYPO3\CMS\Extbase\Domain\Model\FrontendUser
    {
        return $GLOBALS['TSFE']->fe_user->user ?? null;
    }

    private function isInstructorOf($user, $instance): bool
    {
        if (!$user || !$instance) {
            return false;
        }

        foreach ($instance->getInstructors() as $instructor) {
            if ($instructor->getUid() === $user['uid']) {
                return true;
            }
        }

        return false;
    }
}