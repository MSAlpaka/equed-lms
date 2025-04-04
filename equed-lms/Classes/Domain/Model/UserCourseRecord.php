<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use DateTimeInterface;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Represents the status and metadata of a course that a user is enrolled in.
 */
class UserCourseRecord extends AbstractEntity
{
    /**
     * @var FrontendUser|null
     */
    protected ?FrontendUser $user = null;

    /**
     * @var Course|null
     */
    protected ?Course $course = null;

    /**
     * Wurde der Kurs durch den Instructor als abgeschlossen markiert?
     *
     * @var bool
     */
    protected bool $completed = false;

    /**
     * Wurde der Abschluss zentral durch das EquEd-Team validiert?
     *
     * @var bool
     */
    protected bool $validated = false;

    /**
     * Eindeutiger Zertifikatscode nach Validierung
     *
     * @var string
     */
    protected string $certificateCode = '';

    /**
     * Datum des bestätigten Kursabschlusses
     *
     * @var DateTimeInterface|null
     */
    protected ?DateTimeInterface $completionDate = null;

    /**
     * PLZ der Teilnehmenden – relevant für Matching
     *
     * @var string
     */
    protected string $participantPostalCode = '';

    /**
     * Status der Instructor-Zuweisung
     * Mögliche Werte: pending, auto_assigned, manually_assigned, declined
     *
     * @var string
     */
    protected string $matchingStatus = 'pending';

    /**
     * Zugewiesener Instructor (FrontendUser)
     *
     * @var FrontendUser|null
     */
    protected ?FrontendUser $instructor = null;

    /**
     * Zugewiesenes Ausbildungszentrum
     *
     * @var Center|null
     */
    protected ?Center $center = null;

    public function getUser(): ?FrontendUser
    {
        return $this->user;
    }

    public function setUser(?FrontendUser $user): void
    {
        $this->user = $user;
    }

    public function getCourse(): ?Course
    {
        return $this->course;
    }

    public function setCourse(?Course $course): void
    {
        $this->course = $course;
    }

    public function isCompleted(): bool
    {
        return $this->completed;
    }

    public function setCompleted(bool $completed): void
    {
        $this->completed = $completed;
    }

    public function isValidated(): bool
    {
        return $this->validated;
    }

    public function setValidated(bool $validated): void
    {
        $this->validated = $validated;
    }

    public function getCertificateCode(): string
    {
        return $this->certificateCode;
    }

    public function setCertificateCode(string $certificateCode): void
    {
        $this->certificateCode = $certificateCode;
    }

    public function getCompletionDate(): ?DateTimeInterface
    {
        return $this->completionDate;
    }

    public function setCompletionDate(?DateTimeInterface $completionDate): void
    {
        $this->completionDate = $completionDate;
    }

    public function getParticipantPostalCode(): string
    {
        return $this->participantPostalCode;
    }

    public function setParticipantPostalCode(string $postalCode): void
    {
        $this->participantPostalCode = $postalCode;
    }

    public function getMatchingStatus(): string
    {
        return $this->matchingStatus;
    }

    public function setMatchingStatus(string $status): void
    {
        $this->matchingStatus = $status;
    }

    public function getInstructor(): ?FrontendUser
    {
        return $this->instructor;
    }

    public function setInstructor(?FrontendUser $instructor): void
    {
        $this->instructor = $instructor;
    }

    public function getCenter(): ?Center
    {
        return $this->center;
    }

    public function setCenter(?Center $center): void
    {
        $this->center = $center;
    }
}