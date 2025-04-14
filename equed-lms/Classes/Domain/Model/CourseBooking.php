<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;

/**
 * Kursbuchung eines Teilnehmenden für einen konkreten Kurs.
 */
class CourseBooking extends AbstractEntity
{
    protected int $pid = 0;

    #[Lazy]
    protected ?FrontendUser $user = null;

    #[Lazy]
    protected ?Course $course = null;

    protected \DateTimeImmutable $bookingDate;

    protected string $status = 'pending'; // 'pending', 'confirmed', 'rejected'

    protected string $comment = '';

    public function __construct()
    {
        $this->bookingDate = new \DateTimeImmutable();
    }

    public function getUser(): ?FrontendUser { return $this->user; }
    public function setUser(?FrontendUser $user): void { $this->user = $user; }

    public function getCourse(): ?Course { return $this->course; }
    public function setCourse(?Course $course): void { $this->course = $course; }

    public function getBookingDate(): \DateTimeImmutable { return $this->bookingDate; }
    public function setBookingDate(\DateTimeImmutable $date): void { $this->bookingDate = $date; }

    public function getStatus(): string { return $this->status; }
    public function setStatus(string $status): void { $this->status = $status; }

    public function getComment(): string { return $this->comment; }
    public function setComment(string $comment): void { $this->comment = $comment; }
}