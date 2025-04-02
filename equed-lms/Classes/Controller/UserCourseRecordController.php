<?php

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Equed\EquedLms\Domain\Repository\UserCourseRecordRepository;

class UserCourseRecordController extends ActionController
{
    /**
     * @var \Equed\EquedLms\Domain\Repository\UserCourseRecordRepository
     */
    protected UserCourseRecordRepository $userCourseRecordRepository;

    public function __construct(UserCourseRecordRepository $userCourseRecordRepository)
    {
        $this->userCourseRecordRepository = $userCourseRecordRepository;
    }

    /**
     * List all records for a user
     */
    public function indexAction(int $userId): void
    {
        $courseRecords = $this->userCourseRecordRepository->findByUser($userId);
        $this->view->assign('courseRecords', $courseRecords);
    }

    /**
     * Show specific course record details
     */
    public function showAction(int $userCourseRecordId): void
    {
        $courseRecord = $this->userCourseRecordRepository->findByIdentifier($userCourseRecordId);
        $this->view->assign('courseRecord', $courseRecord);
    }
}