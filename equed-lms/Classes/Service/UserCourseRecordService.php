<?php

namespace Equed\EquedLms\Service;

use Equed\EquedLms\Domain\Repository\UserCourseRecordRepository;

class UserCourseRecordService
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
     * Get the course record for a user and course
     */
    public function getUserCourseRecord(int $userId, int $courseId): ?object
    {
        $records = $this->userCourseRecordRepository->findByUser($userId);
        foreach ($records as $record) {
            if ($record->getCourse()->getId() === $courseId) {
                return $record;
            }
        }

        return null;
    }

    /**
     * Mark course completion for a user
     */
    public function markCourseCompleted(int $userId, int $courseId): void
    {
        $record = $this->getUserCourseRecord($userId, $courseId);
        if ($record) {
            $record->setValidated(true);
            $this->userCourseRecordRepository->update($record);
        }
    }
}