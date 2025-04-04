<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Model\CourseInstance;
use EquedLms\Domain\Repository\CourseInstanceRepository;
use EquedLms\Domain\Repository\CourseProgramRepository;
use EquedLms\Domain\Repository\CenterRepository;
use EquedLms\Domain\Repository\FrontendUserRepository;
use Psr\Log\LoggerInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Annotation\IgnoreValidation;

class CourseInstanceController extends ActionController
{
    protected CourseInstanceRepository $courseInstanceRepository;
    protected CourseProgramRepository $courseProgramRepository;
    protected CenterRepository $centerRepository;
    protected FrontendUserRepository $frontendUserRepository;
    protected LoggerInterface $logger;

    public function __construct(
        CourseInstanceRepository $courseInstanceRepository,
        CourseProgramRepository $courseProgramRepository,
        CenterRepository $centerRepository,
        FrontendUserRepository $frontendUserRepository,
        LoggerInterface $logger
    ) {
        $this->courseInstanceRepository = $courseInstanceRepository;
        $this->courseProgramRepository = $courseProgramRepository;
        $this->centerRepository = $centerRepository;
        $this->frontendUserRepository = $frontendUserRepository;
        $this->logger = $logger;
    }

    public function listAction(): void
    {
        $instances = $this->courseInstanceRepository->findAll();
        $this->view->assign('courseInstances', $instances);
    }

    public function showAction(CourseInstance $courseInstance): void
    {
        $this->view->assign('courseInstance', $courseInstance);
    }

    public function newAction(): void
    {
        $this->view->assignMultiple([
            'coursePrograms' => $this->courseProgramRepository->findAll(),
            'centers' => $this->centerRepository->findAll(),
            'instructors' => $this->frontendUserRepository->findAllInstructors()
        ]);
    }

    #[IgnoreValidation('courseInstance')]
    public function createAction(CourseInstance $courseInstance): void
    {
        $this->courseInstanceRepository->add($courseInstance);
        $this->logger->info('CourseInstance created', ['id' => $courseInstance->getUid()]);
        $this->redirect('list');
    }

    public function editAction(CourseInstance $courseInstance): void
    {
        $this->view->assignMultiple([
            'courseInstance' => $courseInstance,
            'coursePrograms' => $this->courseProgramRepository->findAll(),
            'centers' => $this->centerRepository->findAll(),
            'instructors' => $this->frontendUserRepository->findAllInstructors()
        ]);
    }

    public function updateAction(CourseInstance $courseInstance): void
    {
        $this->courseInstanceRepository->update($courseInstance);
        $this->logger->info('CourseInstance updated', ['id' => $courseInstance->getUid()]);
        $this->redirect('list');
    }

    public function deleteAction(CourseInstance $courseInstance): void
    {
        $this->courseInstanceRepository->remove($courseInstance);
        $this->logger->info('CourseInstance deleted', ['id' => $courseInstance->getUid()]);
        $this->redirect('list');
    }
}