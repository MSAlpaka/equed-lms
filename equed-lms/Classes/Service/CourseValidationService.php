<?php

declare(strict_types=1);

namespace Equed\EquedLms\Service;

use Equed\EquedLms\Domain\Repository\UserCourseRecordRepository;

/**
 * Service to validate course completion status
 */
class CourseValidationService
{
    public function __construct(
        private readonly UserCourseRecordRepository $userCourseRecordRepository
    ) {}

    /**
     * Validate whether a user has completed and passed a specific course
     *
     * @param int $userId
     * @param int $courseId
     * @return bool
     */
    public function validateCourseCompletion(int $userId, int $courseId): bool
    {
        $courseRecords = $this->userCourseRecordRepository->findByUser($userId);

        foreach ($courseRecords as $courseRecord) {
            if (
                $courseRecord->getCourse()?->getId() === $courseId &&
                !$courseRecord->getValidated()
            ) {
                return false;
            }
        }

        return true;
    }
}