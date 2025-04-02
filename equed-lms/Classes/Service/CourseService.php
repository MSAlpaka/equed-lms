<?php

namespace Equed\EquedLms\Service;

use Equed\EquedLms\Domain\Repository\CourseRepository;

class CourseService
{
    /**
     * @var \Equed\EquedLms\Domain\Repository\CourseRepository
     */
    protected CourseRepository $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    /**
     * Get all visible courses for a specific center
     */
    public function getVisibleCoursesByCenter(int $centerId): array
    {
        return $this->courseRepository->findByCenter($centerId);
    }

    /**
     * Get course by course code
     */
    public function getCourseByCode(string $courseCode): ?object
    {
        return $this->courseRepository->findOneByCourseCode($courseCode);
    }
}