<?php
namespace EquedLms\Tests\Functional;

use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

class CourseInstanceFrontendTest extends FunctionalTestCase
{
    protected $coreExtensionsToLoad = ['extbase', 'fluid'];

    public function testCourseInstancesAreDisplayedInFrontend()
    {
        $this->importDataSet('course_instance_data.xml');

        // Simulating a frontend request to the /courses page
        $this->simulateFrontendRequest('/courses');

        // Check if course instances are displayed
        $this->assertSelectorTextContains('h1', 'Course Instances');
        $this->assertSelectorExists('.course-instance-item');
    }
}