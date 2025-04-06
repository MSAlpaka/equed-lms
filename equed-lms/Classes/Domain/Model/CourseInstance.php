<?php
declare(strict_types=1);

namespace EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class CourseInstance extends AbstractEntity
{
    /**
     * @var string
     */
    protected string $title;

    /**
     * @var \DateTime
     */
    protected \DateTime $startDate;

    /**
     * @var \DateTime
     */
    protected \DateTime $endDate;

    /**
     * @var bool
     */
    protected bool $isPublic = false;

    /**
     * @var int
     */
    protected int $maxParticipants;

    /**
     * @var ObjectStorage<CourseExam>
     * @TYPO3\CMS\Extbase\Annotation\Cascade("remove")
     */
    protected ObjectStorage $exams;

    /**
     * @var CourseProgram
     */
    protected CourseProgram $program;

    /**
     * @var Center
     */
    protected Center $center;

    /**
     * @var bool
     */
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
        $this->exams = new ObjectStorage();
        $this->instructors = new ObjectStorage();
        $this->userCourseRecords = new ObjectStorage();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getIsPublic(): bool
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

    /**
     * @return ObjectStorage<CourseExam>
     */
    public function getExams(): ObjectStorage
    {
        return $this->exams;
    }

    public function addExam(CourseExam $exam): void
    {
        $this->exams->attach($exam);
    }

    public function removeExam(CourseExam $exam): void
    {
        $this->exams->detach($exam);
    }

    public function getProgram(): CourseProgram
    {
        return $this->program;
    }

    public function setProgram(CourseProgram $program): void
    {
        $this->program = $program;
    }

    public function getCenter(): Center
    {
        return $this->center;
    }

    public function setCenter(Center $center): void
    {
        $this->center = $center;
    }

    public function getAutoAssignInstructor(): bool
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

    public function addUserCourseRecord(UserCourseRecord $userCourseRecord): void
    {
        $this->userCourseRecords->attach($userCourseRecord);
    }

    public function removeUserCourseRecord(UserCourseRecord $userCourseRecord): void
    {
        $this->userCourseRecords->detach($userCourseRecord);
    }

    /**
     * Prüft, ob alle Prüfungen in dieser Kursinstanz bestanden wurden.
     *
     * @return bool
     */
    public function isCourseCompleted(): bool
    {
        foreach ($this->getExams() as $exam) {
            if ($exam->getStatus() !== 'Passed') {
                return false; // Eine Prüfung wurde nicht bestanden
            }
        }
        return true; // Alle Prüfungen bestanden
    }
}