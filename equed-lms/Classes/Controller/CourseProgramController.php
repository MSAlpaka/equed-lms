<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Model\CourseProgram;
use EquedLms\Domain\Repository\CourseProgramRepository;
use Psr\Log\LoggerInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class CourseProgramController extends ActionController
{
    protected CourseProgramRepository $courseProgramRepository;

    public function __construct(CourseProgramRepository $courseProgramRepository)
    {
        $this->courseProgramRepository = $courseProgramRepository;
    }

    public function listAction(): void
    {
        $items = $this->courseProgramRepository->findAll();
        $this->view->assign('coursePrograms', $items);
    }

    public function showAction(CourseProgram $courseProgram): void
    {
        $this->view->assign('courseProgram', $courseProgram);
    }

    public function createAction(CourseProgram $courseProgram): void
    {
        $this->courseProgramRepository->add($courseProgram);
        $this->redirect('list');
    }

    public function updateAction(CourseProgram $courseProgram): void
    {
        $this->courseProgramRepository->update($courseProgram);
        $this->redirect('list');
    }

    public function deleteAction(CourseProgram $courseProgram): void
    {
        $this->courseProgramRepository->remove($courseProgram);
        $this->redirect('list');
    }
}