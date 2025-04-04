<?php

declare(strict_types=1);

namespace Equed\EquedLms\Service;

use Equed\EquedLms\Domain\Model\FrontendUser;
use Equed\EquedLms\Domain\Model\UserCourseRecord;
use Equed\EquedLms\Domain\Repository\UserCourseRecordRepository;
use Psr\Log\LoggerInterface;

/**
 * Service for handling user course records and their status
 */
class UserCourseRecordService
{
    public function __construct(
        private readonly UserCourseRecordRepository $userCourseRecordRepository,
        private readonly LoggerInterface $logger
    ) {}

    /**
     * Check if a user has already booked a course in the program
     *
     * @param int $userId
     * @param int $programId
     * @return bool
     */
    public function hasAlreadyBooked(int $userId, int $programId): bool
    {
        return count($this->userCourseRecordRepository->findByUserAndProgram($userId, $programId)) > 0;
    }

    /**
     * Mark the course record as completed
     *
     * @param UserCourseRecord $record
     * @param FrontendUser $instructor
     */
    public function markAsCompleted(UserCourseRecord $record, FrontendUser $instructor): void
    {
        try {
            $record->setStatus('completed');
            $record->setMarkedAsCompletedBy($instructor);
            $record->setMarkedAsCompletedAt(new \DateTimeImmutable());

            $this->userCourseRecordRepository->update($record);
        } catch (\Throwable $e) {
            $this->logger->error('Error marking course record as completed', [
                'recordId' => $record->getId(),
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException('Unable to mark course record as completed.');
        }
    }

    /**
     * Validate the course record and issue a certificate
     *
     * @param UserCourseRecord $record
     * @param FrontendUser $certifier
     */
    public function validateRecord(UserCourseRecord $record, FrontendUser $certifier): void
    {
        try {
            $record->setValidatedBy($certifier);
            $record->setValidatedAt(new \DateTimeImmutable());
            $record->setCertificateIssued(true);

            $this->userCourseRecordRepository->update($record);
        } catch (\Throwable $e) {
            $this->logger->error('Error validating course record', [
                'recordId' => $record->getId(),
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException('Unable to validate course record.');
        }
    }
}