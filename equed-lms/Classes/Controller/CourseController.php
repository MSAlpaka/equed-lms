<?php

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Equed\EquedLms\Domain\Repository\CourseRepository;

class CourseController extends ActionController
{
    /**
     * @var \Equed\EquedLms\Domain\Repository\CourseRepository
     */
    protected CourseRepository $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    /**
     * List all active and visible courses
     */
    public function indexAction(): void
    {
        $courses = $this->courseRepository->findAllVisible();
        $this->view->assign('courses', $courses);
    }

    /**
     * Show course details
     */
    public function showAction(int $courseId): void
    {
        $course = $this->courseRepository->findOneByCourseCode($courseId);
        $this->view->assign('course', $course);
    }
}