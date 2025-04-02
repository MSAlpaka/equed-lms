<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use Equed\EquedLms\Domain\Model\UserSubmission;
use Equed\EquedLms\Domain\Repository\CourseRepository;

class UserSubmissionRepository extends Repository
{
    public function __construct(
        protected CourseRepository $courseRepository
    ) {}

    public function submit(
        int $feUserId,
        int $courseId,
        string $type,
        FileReference $file,
        string $comment = '',
        string $grade = ''
    ): void {
        $submission = new UserSubmission();
        $submission->setFeUser($feUserId);

        $course = $this->courseRepository->findByUid($courseId);
        if ($course !== null) {
            $submission->setCourse($course);
        }

        $submission->setType($type);
        $submission->setStatus('submitted');
        $submission->setDocument($file);
        $submission->setComment($comment);
        $submission->setGrade($grade);
        $submission->setSubmittedAt(new \DateTimeImmutable());

        $this->add($submission);
    }
}