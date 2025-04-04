<?php

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Equed\EquedLms\Domain\Repository\CourseRepository;
use Equed\EquedLms\Domain\Model\Course;
use TYPO3\CMS\Core\Messaging\AbstractMessage;

class CourseController extends ActionController
{
    protected CourseRepository $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    /**
     * Displays a list of all visible courses
     *
     * @return void
     */
    public function indexAction(): void
    {
        $courses = $this->courseRepository->findAllVisible();
        $this->view->assign('courses', $courses);
    }

    /**
     * Displays details of a specific course
     *
     * @param int $courseId UID of the course
     * @return void
     */
    public function showAction(int $courseId): void
    {
        $course = $this->courseRepository->findByUid($courseId);

        if (!$course instanceof Course) {
            $this->addFlashMessage(
                $this->translate('course.notFound.message'),
                $this->translate('course.notFound.title'),
                AbstractMessage::ERROR
            );
            $this->redirect('index');
        }

        $this->view->assign('course', $course);
    }

    /**
     * Helper method for translation
     *
     * @param string $key
     * @param array $arguments
     * @return string
     */
    protected function translate(string $key, array $arguments = []): string
    {
        return $this->getLanguageService()->sL(
            'LLL:EXT:equed_lms/Resources/Private/Language/locallang.xlf:' . $key,
            $arguments
        ) ?? $key;
    }

    /**
     * Returns the TYPO3 language service
     *
     * @return \TYPO3\CMS\Core\Localization\LanguageService
     */
    protected function getLanguageService(): \TYPO3\CMS\Core\Localization\LanguageService
    {
        return $GLOBALS['LANG'] ?? $GLOBALS['BE_USER']->uc['lang'] ?? $GLOBALS['TSFE']->lang ?? 'en';
    }
}