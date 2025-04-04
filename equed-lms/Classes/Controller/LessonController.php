<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Model\Lesson;
use EquedLms\Domain\Repository\LessonRepository;
use EquedLms\Domain\Repository\CourseProgramRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Annotation\IgnoreValidation;

class LessonController extends ActionController
{
    protected LessonRepository $lessonRepository;
    protected CourseProgramRepository $courseProgramRepository;

    public function __construct(
        LessonRepository $lessonRepository,
        CourseProgramRepository $courseProgramRepository
    ) {
        $this->lessonRepository = $lessonRepository;
        $this->courseProgramRepository = $courseProgramRepository;
    }

    public function listAction(): void
    {
        $lessons = $this->lessonRepository->findAll();
        $this->view->assign('lessons', $lessons);
    }

    public function showAction(Lesson $lesson): void
    {
        $this->view->assign('lesson', $lesson);
    }

    public function newAction(): void
    {
        $this->view->assign('coursePrograms', $this->courseProgramRepository->findAll());
    }

    #[IgnoreValidation('lesson')]
    public function createAction(Lesson $lesson): void
    {
        $this->lessonRepository->add($lesson);
        $this->redirect('list');
    }

    public function editAction(Lesson $lesson): void
    {
        $this->view->assignMultiple([
            'lesson' => $lesson,
            'coursePrograms' => $this->courseProgramRepository->findAll()
        ]);
    }

    public function updateAction(Lesson $lesson): void
    {
        $this->lessonRepository->update($lesson);
        $this->redirect('list');
    }

    public function deleteAction(Lesson $lesson): void
    {
        $this->lessonRepository->remove($lesson);
        $this->redirect('list');
    }
}