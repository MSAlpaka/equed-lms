<?php

declare(strict_types=1);

namespace Equed\EquedLms\Service;

use Equed\EquedLms\Domain\Model\Instructor;
use Equed\EquedLms\Domain\Repository\InstructorRepository;

/**
 * Service to find suitable instructors based on specialty
 */
class InstructorMatchingService
{
    public function __construct(
        private readonly InstructorRepository $instructorRepository
    ) {}

    /**
     * Find the first instructor that matches a given specialty
     *
     * @param string $specialty
     * @return Instructor|null
     */
    public function findInstructorBySpecialty(string $specialty): ?Instructor
    {
        $instructors = $this->instructorRepository->findBySpecialty($specialty);
        return $instructors[0] ?? null;
    }
}