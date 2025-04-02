<?php

namespace Equed\EquedLms\Service;

use Equed\EquedLms\Domain\Repository\UserCourseRecordRepository;

class CourseValidationService
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
     * Validate whether a user has completed all requirements for a course
     */
    public function validateCourseCompletion(int $userId, int $courseId): bool
    {
        $courseRecords = $this->userCourseRecordRepository->findByUser($userId);

        // Check if all course records are validated for the user and course
        foreach ($courseRecords as $courseRecord) {
            if ($courseRecord->getCourse()->getId() === $courseId && !$courseRecord->getValidated()) {
                return false;
            }
        }

        return true; // Course is completed and validated
    }
}