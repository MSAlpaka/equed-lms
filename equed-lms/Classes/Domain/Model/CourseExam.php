<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;

/**
 * Repräsentiert eine Prüfung innerhalb eines Kurses.
 *
 * Typischerweise Theorie, Praxis oder Fallstudie mit Bestehensgrenze und Status.
 */
class CourseExam extends AbstractEntity
{
    protected int $pid = 0;

    /**
     * Typ der Prüfung (z. B. "Theory", "Practical", "Case Study")
     */
    protected string $examType = '';

    /**
     * Prozentzahl, die zum Bestehen erreicht werden muss
     */
    protected int $passingGrade = 0;

    /**
     * Status der Prüfung (z. B. "Passed", "Failed", "Pending")
     */
    protected string $status = 'Pending';

    protected ?\DateTimeImmutable $examDate = null;

    #[Lazy]
    protected ?CourseInstance $courseInstance = null;

    public function getPid(): int
    {
        return $this->pid;
    }

    public function setPid(int $pid): void
    {
        $this->pid = $pid;
    }

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

    public function getExamDate(): ?\DateTimeImmutable
    {
        return $this->examDate;
    }

    public function setExamDate(?\DateTimeImmutable $examDate): void
    {
        $this->examDate = $examDate;
    }

    public function getCourseInstance(): ?CourseInstance
    {
        return $this->courseInstance;
    }

    public function setCourseInstance(?CourseInstance $courseInstance): void
    {
        $this->courseInstance = $courseInstance;
    }
}