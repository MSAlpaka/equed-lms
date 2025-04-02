<?php

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use Equed\EquedLms\Domain\Model\Course;
use Equed\EquedLms\Domain\Repository\CourseRepository;
use Equed\EquedLms\Domain\Repository\UserLessonProgressRepository;

class BackendController extends ActionController
{
    protected CourseRepository $courseRepository;
    protected UserLessonProgressRepository $userProgressRepository;

    public function __construct(
        CourseRepository $courseRepository,
        UserLessonProgressRepository $userProgressRepository
    ) {
        $this->courseRepository = $courseRepository;
        $this->userProgressRepository = $userProgressRepository;
    }

    public function listAction(): void
    {
        $courses = $this->courseRepository->findAll();
        $this->view->assign('courses', $courses);
    }

    public function showAction(Course $course): void
    {
        $context = GeneralUtility::makeInstance(Context::class);
        $beUserId = $context->getPropertyFromAspect('backend.user', 'id');

        $progress = $this->userProgressRepository->getProgressByUserAndCourse($beUserId ?? 1, $course);

        $this->view->assignMultiple([
            'course' => $course,
            'progress' => $progress
        ]);
    }

    public function newAction(): void
    {
        $newCourse = new Course();
        $this->view->assign('newCourse', $newCourse);
    }

    public function createAction(Course $newCourse): void
    {
        $this->courseRepository->add($newCourse);
        $this->addFlashMessage('Kurs wurde erfolgreich erstellt.', 'Erfolg', FlashMessage::OK);
        $this->redirect('list');
    }

    public function editAction(Course $course): void
    {
        $this->view->assign('course', $course);
    }

    public function updateAction(Course $course): void
    {
        $this->courseRepository->update($course);
        $this->addFlashMessage('Kurs wurde erfolgreich aktualisiert.', 'Aktualisiert', FlashMessage::OK);
        $this->redirect('list');
    }

    public function deleteAction(Course $course): void
    {
        $this->courseRepository->remove($course);
        $this->addFlashMessage('Kurs wurde gelöscht.', 'Gelöscht', FlashMessage::WARNING);
        $this->redirect('list');
    }
}