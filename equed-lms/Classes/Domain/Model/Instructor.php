<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Instructor extends AbstractEntity
{
    protected string $name = '';
    protected string $email = '';
    protected bool $isAvailable = true;

    /** @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<Course> */
    protected $canTeachCourses;

    protected string $regionPostalCodes = '';

    public function __construct()
    {
        $this->canTeachCourses = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function isAvailable(): bool
    {
        return $this->isAvailable;
    }

    public function setIsAvailable(bool $isAvailable): void
    {
        $this->isAvailable = $isAvailable;
    }

    public function getRegionPostalCodes(): string
    {
        return $this->regionPostalCodes;
    }

    public function setRegionPostalCodes(string $regionPostalCodes): void
    {
        $this->regionPostalCodes = $regionPostalCodes;
    }

    public function getCanTeachCourses()
    {
        return $this->canTeachCourses;
    }

    public function addCanTeachCourse(Course $course): void
    {
        $this->canTeachCourses->attach($course);
    }
}