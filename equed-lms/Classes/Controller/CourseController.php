<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Model\Course;
use EquedLms\Domain\Repository\CourseRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ResponseInterface;

class CourseController extends ActionController
{
    public function __construct(
        protected readonly CourseRepository $courseRepository,
        protected readonly LoggerInterface $logger
    ) {}

    /**
     * Displays a list of all visible courses.
     */
    public function indexAction(): ResponseInterface
    {
        $courses = $this->courseRepository->findAllVisible();
        $this->view->assign('courses', $courses);

        $this->logger->info('Visible course list shown', ['count' => count($courses)]);

        return $this->htmlResponse();
    }

    /**
     * Displays a single course.
     */
    public function showAction(int $courseId): ResponseInterface
    {
        $course = $this->courseRepository->findByUid($courseId);

        if (!$course instanceof Course) {
            $this->logger->warning('Course not found', ['uid' => $courseId]);

            $this->addFlashMessage(
                $this->translate('course.notFound.message') ?? 'The requested course was not found.',
                $this->translate('course.notFound.title') ?? 'Course not found',
                AbstractMessage::ERROR
            );

            return $this->redirect('index');
        }

        $this->view->assign('course', $course);

        $this->logger->info('Course shown', [
            'uid' => $course->getUid(),
            'title' => $course->getTitle(),
        ]);

        return $this->htmlResponse();
    }

    /**
     * Helper to translate language keys.
     */
    protected function translate(string $key, array $arguments = []): ?string
    {
        return LocalizationUtility::translate(
            $key,
            'equed_lms',
            $arguments
        ) ?? null;
    }
}
