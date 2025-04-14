<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;

class CourseInstance extends AbstractEntity
{
    protected int $pid = 0;

    protected string $title = '';
    protected \DateTimeImmutable $startDate;
    protected \DateTimeImmutable $endDate;
    protected bool $isPublic = false;
    protected int $maxParticipants = 0;
    protected bool $autoAssignInstructor = false;

    #[Lazy]
    protected ?CourseProgram $program = null;

    #[Lazy]
    protected ?Center $center = null;

    /** @var ObjectStorage<FrontendUser> */
    #[Lazy]
    protected ObjectStorage $instructors;

    /** @var ObjectStorage<UserCourseRecord> */
    #[Lazy]
    protected ObjectStorage $userCourseRecords;

    public function __construct()
    {
        $this->startDate = new \DateTimeImmutable();
        $this->endDate = new \DateTimeImmutable();
        $this->instructors = new ObjectStorage();
        $this->userCourseRecords = new ObjectStorage();
    }

    public function getTitle(): string { return $this->title; }
    public function setTitle(string $title): void { $this->title = $title; }

    public function getStartDate(): \DateTimeImmutable { return $this->startDate; }
    public function setStartDate(\DateTimeImmutable $startDate): void { $this->startDate = $startDate; }

    public function getEndDate(): \DateTimeImmutable { return $this->endDate; }
    public function setEndDate(\DateTimeImmutable $endDate): void { $this->endDate = $endDate; }

    public function isPublic(): bool { return $this->isPublic; }
    public function setIsPublic(bool $public): void { $this->isPublic = $public; }

    public function getMaxParticipants(): int { return $this->maxParticipants; }
    public function setMaxParticipants(int $max): void { $this->maxParticipants = $max; }

    public function isAutoAssignInstructor(): bool { return $this->autoAssignInstructor; }
    public function setAutoAssignInstructor(bool $value): void { $this->autoAssignInstructor = $value; }

    public function getProgram(): ?CourseProgram { return $this->program; }
    public function setProgram(?CourseProgram $program): void { $this->program = $program; }

    public function getCenter(): ?Center { return $this->center; }
    public function setCenter(?Center $center): void { $this->center = $center; }

    public function getInstructors(): ObjectStorage { return $this->instructors; }
    public function addInstructor(FrontendUser $instructor): void { $this->instructors->attach($instructor); }

    public function getUserCourseRecords(): ObjectStorage { return $this->userCourseRecords; }
    public function addUserCourseRecord(UserCourseRecord $record): void { $this->userCourseRecords->attach($record); }
}