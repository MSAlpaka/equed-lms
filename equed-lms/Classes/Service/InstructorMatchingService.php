<?php

namespace Equed\EquedLms\Service;

use Equed\EquedLms\Domain\Repository\InstructorRepository;

class InstructorMatchingService
{
    /**
     * @var \Equed\EquedLms\Domain\Repository\InstructorRepository
     */
    protected InstructorRepository $instructorRepository;

    public function __construct(InstructorRepository $instructorRepository)
    {
        $this->instructorRepository = $instructorRepository;
    }

    /**
     * Find an instructor by specialty
     */
    public function findInstructorBySpecialty(string $specialty): ?object
    {
        // Logic to find instructor based on specialty
        $instructors = $this->instructorRepository->findBySpecialty($specialty);
        return $instructors ? $instructors[0] : null; // Return the first matching instructor
    }
}