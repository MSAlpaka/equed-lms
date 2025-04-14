<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Model\CourseInstance;
use EquedLms\Domain\Repository\CourseInstanceRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Authentication\FrontendUserAuthentication;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Exception\AccessDeniedException;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ResponseInterface;

class CertifierController extends ActionController
{
    public function __construct(
        protected readonly CourseInstanceRepository $courseInstanceRepository,
        protected readonly LoggerInterface $logger
    ) {}

    /**
     * Validates a course instance.
     */
    public function validateAction(int $courseInstanceId): ResponseInterface
    {
        $frontendUser = $this->getFrontendUser();
        $userId = $frontendUser?->user['uid'] ?? 0;

        if (!$this->userIsCertifier()) {
            $this->logger->warning('Validation denied: user is not a certifier', ['userId' => $userId]);
            throw new AccessDeniedException('Access denied: Only certifiers may perform validation.');
        }

        $course = $this->courseInstanceRepository->findByUid($courseInstanceId);

        if (!$course instanceof CourseInstance) {
            $this->addFlashMessage(
                LocalizationUtility::translate('course_not_found', 'equed_lms') ?? 'Course not found.',
                '',
                AbstractMessage::ERROR
            );
            return $this->redirect('list', 'CourseInstance');
        }

        if (!$course->getRequiresExternalValidation()) {
            $this->addFlashMessage(
                LocalizationUtility::translate('course_no_validation_needed', 'equed_lms')
                    ?? 'This course does not require external validation.',
                '',
                AbstractMessage::INFO
            );
            $this->logger->info('Validation skipped – not required.', ['courseId' => $course->getUid()]);
            return $this->redirect('show', 'CourseInstance', null, ['courseInstance' => $course->getUid()]);
        }

        $course->setStatus('validated');
        $this->courseInstanceRepository->update($course);

        $this->addFlashMessage(
            LocalizationUtility::translate('course_validated', 'equed_lms')
                ?? 'Course successfully validated.',
            '',
            AbstractMessage::OK
        );

        $this->logger->info('CourseInstance validated by certifier', [
            'courseInstanceId' => $course->getUid(),
            'certifierId' => $userId,
        ]);

        return $this->redirect('show', 'CourseInstance', null, ['courseInstance' => $course->getUid()]);
    }

    /**
     * Checks if the current user is a certifier.
     */
    protected function userIsCertifier(): bool
    {
        $context = GeneralUtility::makeInstance(Context::class);
        $groups = $context->getPropertyFromAspect('frontend.user', 'groupIds') ?? [];

        return in_array(123, $groups, true); // TODO: Replace 123 with real certifier group UID
    }

    /**
     * Returns the current FE user object.
     */
    protected function getFrontendUser(): ?FrontendUserAuthentication
    {
        return $GLOBALS['TSFE']->fe_user ?? null;
    }
}
