<?php
namespace Equed\EquedLms\Security;

use TYPO3\CMS\Core\Authentication\AuthenticationService;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class RoleMap
{
    /**
     * Maps the user roles for EquEd LMS
     *
     * @return array
     */
    public function getRoleMap()
    {
        return [
            'learner' => [
                'title' => 'Learner',
                'permissions' => [
                    'view_courses' => true,
                    'submit_assignments' => true,
                    'view_certificates' => true,
                    'submit_feedback' => true
                ]
            ],
            'instructor' => [
                'title' => 'Instructor',
                'permissions' => [
                    'view_courses' => true,
                    'create_courses' => true,
                    'manage_students' => true,
                    'grade_assignments' => true,
                    'generate_certificates' => true,
                    'view_feedback' => true
                ]
            ],
            'certifier' => [
                'title' => 'Certifier',
                'permissions' => [
                    'view_courses' => true,
                    'verify_certifications' => true,
                    'approve_certifications' => true
                ]
            ],
            'admin' => [
                'title' => 'Administrator',
                'permissions' => [
                    'manage_courses' => true,
                    'manage_instructors' => true,
                    'manage_users' => true,
                    'manage_settings' => true,
                    'view_reports' => true
                ]
            ]
        ];
    }
}