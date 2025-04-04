<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;

/**
 * Einreichung eines Teilnehmenden (z. B. für Tests, Fallberichte, Prüfungen etc.)
 */
class UserSubmission extends AbstractEntity
{
    /**
     * @var FrontendUser|null
     */
    protected ?FrontendUser $feUser = null;

    /**
     * Typ der Einreichung (z. B. 'theory_test', 'practical_case', 'report')
     *
     * @var string
     */
    protected string $type = '';

    /**
     * Status der Einreichung (z. B. 'submitted', 'approved', 'rejected')
     *
     * @var string
     */
    protected string $status = '';

    /**
     * Optionaler Kommentar oder Feedback
     *
     * @var string
     */
    protected string $comment = '';

    /**
     * Bewertung (z. B. Note, Punkte, bestanden/nicht bestanden)
     *
     * @var string
     */
    protected string $grade = '';

    /**
     * Zugehöriger Kurs-Teilnahmedatensatz
     *
     * @var UserCourseRecord|null
     */
    protected ?UserCourseRecord $userCourseRecord = null;

    /**
     * Zugehörige Lektion (falls einreichungsspezifisch)
     *
     * @var Lesson|null
     */
    protected ?Lesson $lesson = null;

    public function getFeUser(): ?FrontendUser
    {
        return $this->feUser;
    }

    public function setFeUser(?FrontendUser $feUser): void
    {
        $this->feUser = $feUser;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

    public function getGrade(): string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): void
    {
        $this->grade = $grade;
    }

    public function getUserCourseRecord(): ?UserCourseRecord
    {
        return $this->userCourseRecord;
    }

    public function setUserCourseRecord(?UserCourseRecord $userCourseRecord): void
    {
        $this->userCourseRecord = $userCourseRecord;
    }

    public function getLesson(): ?Lesson
    {
        return $this->lesson;
    }

    public function setLesson(?Lesson $lesson): void
    {
        $this->lesson = $lesson;
    }
}