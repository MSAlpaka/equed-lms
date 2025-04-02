<?php

namespace Equed\EquedLms\Domain\Repository;

use Equed\EquedLms\Domain\Model\UserSubmission;
use Equed\EquedLms\Domain\Model\Course;
use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Object\ObjectManager;

class UserSubmissionRepository extends Repository
{
    public function __construct(
        protected ObjectManager $objectManager
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

        $course = $this->findCourseById($courseId);
        if ($course instanceof Course) {
            $submission->setCourse($course);
        }

        $submission->setType($type);
        $submission->setStatus('submitted');
        $submission->setDocument($file); // <- angepasst
        $submission->setSubmittedAt(new \DateTime());
        $submission->setComment($comment);
        $submission->setGrade($grade);

        $this->add($submission);
        $this->persistenceManager->persistAll();
    }

    public function findByUserAndCourse(int $feUserId, int $courseId): array
    {
        return $this->createQuery()
            ->matching(
                $this->createQuery()->logicalAnd([
                    $this->createQuery()->equals('feUser', $feUserId),
                    $this->createQuery()->equals('course', $courseId)
                ])
            )
            ->execute()
            ->toArray();
    }

    public function findByFeUser(int $feUserId): array
    {
        return $this->createQuery()
            ->matching(
                $this->createQuery()->equals('feUser', $feUserId)
            )
            ->execute()
            ->toArray();
    }

    protected function findCourseById(int $courseId): ?Course
    {
        return $this->objectManager
            ->get(\Equed\EquedLms\Domain\Repository\CourseRepository::class)
            ->findByIdentifier($courseId);
    }
}