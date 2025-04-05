<?php
// CertifierController.php

namespace Vendor\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Vendor\EquedLms\Domain\Model\Course;
use Vendor\EquedLms\Domain\Repository\CourseRepository;

class CertifierController extends ActionController
{
    /**
     * @var CourseRepository
     */
    protected $courseRepository;

    /**
     * @param CourseRepository $courseRepository
     */
    public function injectCourseRepository(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    /**
     * Validate a course (only for Certifiers and when validation is required)
     */
    public function validateAction($courseId)
    {
        $course = $this->courseRepository->findByUid($courseId);

        if ($course->getRequiresExternalValidation()) {
            // Ensure the user is a Certifier
            if ($this->getAuthenticatedUser()->hasRole('Certifier')) {
                // Mark the course as validated
                $course->setStatus('validated');
                $this->courseRepository->update($course);
                $this->addFlashMessage(
                    $this->translate('course_validated')
                );
            } else {
                $this->addFlashMessage(
                    $this->translate('error_no_validation_permission'),
                    '',
                    \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR
                );
            }
        } else {
            $this->addFlashMessage(
                $this->translate('course_no_validation_needed'),
                '',
                \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO
            );
        }
    }

    /**
     * Helper function to get the authenticated user
     */
    protected function getAuthenticatedUser()
    {
        // Assuming we have a method to retrieve the logged-in user
        return $this->getUser();
    }

    /**
     * Helper function for translation
     */
    protected function translate($key)
    {
        return $this->getLocalizationService()->getLocalizedString($key);
    }
}
?>