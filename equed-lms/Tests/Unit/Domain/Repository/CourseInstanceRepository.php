<?php
namespace EquedLms\Tests\Unit\Domain\Repository;

use TYPO3\TestingFramework\Core\Unit\UnitTestCase;
use EquedLms\Domain\Repository\CourseInstanceRepository;
use EquedLms\Domain\Model\CourseProgram;
use EquedLms\Domain\Model\CourseInstance;

class CourseInstanceRepositoryTest extends UnitTestCase
{
    /**
     * @var CourseInstanceRepository
     */
    protected $courseInstanceRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->courseInstanceRepository = $this->createMock(CourseInstanceRepository::class);
    }

    public function testFindPublicByProgram()
    {
        $program = new CourseProgram();
        $program->setTitle('Test Program');

        // Mocking the repository method
        $this->courseInstanceRepository->method('findPublicByProgram')
            ->willReturn([new CourseInstance(), new CourseInstance()]);

        $instances = $this->courseInstanceRepository->findPublicByProgram($program);

        // Verifying if 2 instances were returned
        $this->assertCount(2, $instances);
    }
}