<?php

declare(strict_types=1);

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Equed\EquedLms\Domain\Repository\InstructorRepository;
use Equed\EquedLms\Domain\Model\Instructor;
use TYPO3\CMS\Core\Error\Http\NotFoundException;

class InstructorController extends ActionController
{
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
     *
     * @param int $instructorId
     * @throws NotFoundException
     */
    public function showAction(int $instructorId): void
    {
        $instructor = $this->instructorRepository->findOneByUserId($instructorId);
        if (!$instructor instanceof Instructor) {
            throw new NotFoundException('Instructor not found.', 1700000010);
        }
        $this->view->assign('instructor', $instructor);
    }
}