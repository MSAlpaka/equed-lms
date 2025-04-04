<?php

declare(strict_types=1);

namespace Equed\EquedLms\Service;

use Equed\EquedLms\Domain\Model\Course;
use Equed\EquedLms\Domain\Repository\CourseRepository;

/**
 * Service for handling course-related logic
 */
class CourseService
{
    public function __construct(
        private readonly CourseRepository $courseRepository
    ) {}

    /**
     * Get all visible courses for a specific center
     *
     * @param int $centerId
     * @return Course[]
     */
    public function getVisibleCoursesByCenter(int $centerId): array
    {
        return $this->courseRepository->findByCenter($centerId);
    }

    /**
     * Get a course by its unique code
     *
     * @param string $courseCode
     * @return Course|null
     */
    public function getCourseByCode(string $courseCode): ?Course
    {
        return $this->courseRepository->findOneByCourseCode($courseCode);
    }
}