<?php
declare(strict_types=1);

namespace EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class CourseExam extends AbstractEntity
{
    protected string $examType; // e.g. "Theory", "Practical", "Case Study"
    protected int $passingGrade; // z.B. 70% für Bestehen
    protected string $status; // z.B. "Passed", "Failed"
    protected ?\DateTime $examDate = null;

    public function getExamType(): string
    {
        return $this->examType;
    }

    public function setExamType(string $examType): void
    {
        $this->examType = $examType;
    }

    public function getPassingGrade(): int
    {
        return $this->passingGrade;
    }

    public function setPassingGrade(int $passingGrade): void
    {
        $this->passingGrade = $passingGrade;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getExamDate(): ?\DateTime
    {
        return $this->examDate;
    }

    public function setExamDate(?\DateTime $examDate): void
    {
        $this->examDate = $examDate;
    }
}