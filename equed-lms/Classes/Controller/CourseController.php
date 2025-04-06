<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Model\Course;
use EquedLms\Domain\Repository\CourseRepository;
use Psr\Log\LoggerInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

class CourseController extends ActionController
{
    public function __construct(
        protected readonly CourseRepository $courseRepository,
        protected readonly LoggerInterface $logger
    ) {}

    /**
     * Zeigt eine Liste sichtbarer Kurse.
     */
    public function indexAction(): void
    {
        $courses = $this->courseRepository->findAllVisible();
        $this->view->assign('courses', $courses);

        $this->logger->info('Kursliste angezeigt', [
            'count' => count($courses),
        ]);
    }

    /**
     * Zeigt Details zu einem einzelnen Kurs.
     */
    public function showAction(int $courseId): void
    {
        $course = $this->courseRepository->findByUid($courseId);

        if (!$course instanceof Course) {
            $this->logger->warning('Kurs nicht gefunden', ['uid' => $courseId]);

            $this->addFlashMessage(
                $this->translate('course.notFound.message') ?? 'Der angeforderte Kurs wurde nicht gefunden.',
                $this->translate('course.notFound.title') ?? 'Kurs nicht gefunden',
                AbstractMessage::ERROR
            );

            $this->redirect('index');
        }

        $this->view->assign('course', $course);

        $this->logger->info('Kurs angezeigt', [
            'uid' => $course->getUid(),
            'title' => $course->getTitle(),
        ]);
    }

    /**
     * Übersetzungsfunktion mit modernem Fallback.
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