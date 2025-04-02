<?php

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Equed\EquedLms\Domain\Repository\InstructorRepository;

class InstructorController extends ActionController
{
    /**
     * @var \Equed\EquedLms\Domain\Repository\InstructorRepository
     */
    protected InstructorRepository $instructorRepository;

    public function __construct(InstructorRepository $instructorRepository)
    {
        $this->instructorRepository = $instructorRepository;
    }

    /**
     * List all verified instructors
     */
    public function indexAction(): void
    {
        $instructors = $this->instructorRepository->findAllVerified();
        $this->view->assign('instructors', $instructors);
    }

    /**
     * Show instructor details
     */
    public function showAction(int $instructorId): void
    {
        $instructor = $this->instructorRepository->findOneByUserId($instructorId);
        $this->view->assign('instructor', $instructor);
    }
}