<?php

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Equed\EquedLms\Domain\Repository\CourseRepository;
use Equed\EquedLms\Domain\Model\Course;
use TYPO3\CMS\Core\Localization\LanguageService;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;

class CourseController extends ActionController implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    public function __construct(
        protected readonly CourseRepository $courseRepository,
        LoggerInterface $logger = null
    ) {
        if ($logger === null) {
            $this->logger = GeneralUtility::makeInstance(LoggerInterface::class);
        } else {
            $this->setLogger($logger);
        }
    }

    public function indexAction(): void
    {
        $courses = $this->courseRepository->findAllVisible();
        $this->view->assign('courses', $courses);
        $this->logger->info('Displayed course list with ' . count($courses) . ' entries.');
    }

    public function showAction(int $courseId): void
    {
        $course = $this->courseRepository->findByUid($courseId);

        if (!$course instanceof Course) {
            $this->logger->warning("Course with UID $courseId not found.");
            $this->addFlashMessage(
                $this->translate('course.notFound.message'),
                $this->translate('course.notFound.title'),
                AbstractMessage::ERROR
            );
            $this->redirect('index');
        }

        $this->view->assign('course', $course);
        $this->logger->info("Displayed course with UID $courseId: " . $course->getTitle());
    }

    protected function translate(string $key, array $arguments = []): string
    {
        return $this->getLanguageService()->sL(
            'LLL:EXT:equed_lms/Resources/Private/Language/locallang.xlf:' . $key,
            $arguments
        ) ?? $key;
    }

    protected function getLanguageService(): LanguageService
    {
        return GeneralUtility::makeInstance(LanguageService::class);
    }
}