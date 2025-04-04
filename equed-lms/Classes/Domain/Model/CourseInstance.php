<?php

declare(strict_types=1);

namespace EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class CourseInstance extends AbstractEntity
{
    protected ?CourseProgram $program = null;
    protected ?Center $center = null;

    protected ?\DateTime $startDate = null;
    protected ?\DateTime $endDate = null;

    protected bool $isPublic = true;
    protected int $maxParticipants = 0;
    protected bool $autoAssignInstructor = false;

    /**
     * @var ObjectStorage<FrontendUser>
     */
    protected ObjectStorage $instructors;

    /**
     * @var ObjectStorage<UserCourseRecord>
     */
    protected ObjectStorage $userCourseRecords;

    public function __construct()
    {
        $this->instructors = new ObjectStorage();
        $this->userCourseRecords = new ObjectStorage();
    }

    public function getProgram(): ?CourseProgram
    {
        return $this->program;
    }

    public function setProgram(?CourseProgram $program): void
    {
        $this->program = $program;
    }

    public function getCenter(): ?Center
    {
        return $this->center;
    }

    public function setCenter(?Center $center): void
    {
        $this->center = $center;
    }

    public function getStartDate(): ?\DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getEndDate(): ?\DateTime
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function isPublic(): bool
    {
        return $this->isPublic;
    }

    public function setIsPublic(bool $isPublic): void
    {
        $this->isPublic = $isPublic;
    }

    public function getMaxParticipants(): int
    {
        return $this->maxParticipants;
    }

    public function setMaxParticipants(int $maxParticipants): void
    {
        $this->maxParticipants = $maxParticipants;
    }

    public function isAutoAssignInstructor(): bool
    {
        return $this->autoAssignInstructor;
    }

    public function setAutoAssignInstructor(bool $autoAssignInstructor): void
    {
        $this->autoAssignInstructor = $autoAssignInstructor;
    }

    /**
     * @return ObjectStorage<FrontendUser>
     */
    public function getInstructors(): ObjectStorage
    {
        return $this->instructors;
    }

    public function addInstructor(FrontendUser $instructor): void
    {
        $this->instructors->attach($instructor);
    }

    public function removeInstructor(FrontendUser $instructor): void
    {
        $this->instructors->detach($instructor);
    }

    /**
     * @return ObjectStorage<UserCourseRecord>
     */
    public function getUserCourseRecords(): ObjectStorage
    {
        return $this->userCourseRecords;
    }

    public function addUserCourseRecord(UserCourseRecord $record): void
    {
        $this->userCourseRecords->attach($record);
    }

    public function removeUserCourseRecord(UserCourseRecord $record): void
    {
        $this->userCourseRecords->detach($record);
    }
}