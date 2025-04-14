<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;

/**
 * Zentrales Kursprogramm: Inhalte, Ziele, Voraussetzungen, Zertifizierungen.
 */
class Course extends AbstractEntity
{
    protected int $pid = 0;

    protected string $title = '';
    protected string $description = '';
    protected string $category = '';
    protected bool $isActive = true;
    protected string $finishGoal = '';
    protected string $prerequisites = ''; // JSON-kompatibles Textfeld

    #[Lazy]
    protected ?FileReference $image = null;

    #[Lazy]
    protected ?Center $center = null;

    #[Lazy]
    protected ?FrontendUser $instructor = null;

    /** @var ObjectStorage<Lesson> */
    protected ObjectStorage $lessons;

    protected string $recommendedSpecialties = ''; // optionales Feld als Freitext oder CSV
    protected bool $grantsCertificate = true;
    protected bool $requiresExternalValidation = false;

    protected int $sorting = 0;

    public function __construct()
    {
        $this->lessons = new ObjectStorage();
    }

    public function getTitle(): string { return $this->title; }
    public function setTitle(string $title): void { $this->title = $title; }

    public function getDescription(): string { return $this->description; }
    public function setDescription(string $description): void { $this->description = $description; }

    public function getCategory(): string { return $this->category; }
    public function setCategory(string $category): void { $this->category = $category; }

    public function isActive(): bool { return $this->isActive; }
    public function setIsActive(bool $active): void { $this->isActive = $active; }

    public function getFinishGoal(): string { return $this->finishGoal; }
    public function setFinishGoal(string $goal): void { $this->finishGoal = $goal; }

    public function getPrerequisites(): string { return $this->prerequisites; }
    public function setPrerequisites(string $prereq): void { $this->prerequisites = $prereq; }

    public function getImage(): ?FileReference { return $this->image; }
    public function setImage(?FileReference $image): void { $this->image = $image; }

    public function getCenter(): ?Center { return $this->center; }
    public function setCenter(?Center $center): void { $this->center = $center; }

    public function getInstructor(): ?FrontendUser { return $this->instructor; }
    public function setInstructor(?FrontendUser $instructor): void { $this->instructor = $instructor; }

    public function getLessons(): ObjectStorage { return $this->lessons; }
    public function addLesson(Lesson $lesson): void { $this->lessons->attach($lesson); }

    public function getRecommendedSpecialties(): string { return $this->recommendedSpecialties; }
    public function setRecommendedSpecialties(string $value): void { $this->recommendedSpecialties = $value; }

    public function isGrantsCertificate(): bool { return $this->grantsCertificate; }
    public function setGrantsCertificate(bool $flag): void { $this->grantsCertificate = $flag; }

    public function isRequiresExternalValidation(): bool { return $this->requiresExternalValidation; }
    public function setRequiresExternalValidation(bool $flag): void { $this->requiresExternalValidation = $flag; }

    public function getSorting(): int { return $this->sorting; }
    public function setSorting(int $sorting): void { $this->sorting = $sorting; }
}