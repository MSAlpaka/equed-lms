<?php

declare(strict_types=1);

namespace Equed\EquedLms\Configuration\AccessControl;

/**
 * Provides a role-permission mapping for the EquEd LMS.
 */
class RoleMap
{
    /**
     * Returns the full map of roles and their permissions.
     *
     * @return array<string, array{title: string, permissions: string[]}>
     */
    public static function getRoleMap(): array
    {
        return [
            'learner' => [
                'title' => 'Learner',
                'permissions' => [
                    'view_courses',
                    'track_progress',
                    'submit_assignments',
                    'view_certificates',
                    'submit_feedback',
                ],
            ],
            'instructor' => [
                'title' => 'Instructor',
                'permissions' => [
                    'view_courses',
                    'create_courses',
                    'edit_courses',
                    'manage_students',
                    'grade_assignments',
                    'generate_certificates',
                    'view_feedback',
                ],
            ],
            'certifier' => [
                'title' => 'Certifier',
                'permissions' => [
                    'view_courses',
                    'view_submissions',
                    'verify_certifications',
                    'approve_certifications',
                    'resolve_qms_cases',
                ],
            ],
            'servicecenter' => [
                'title' => 'ServiceCenter',
                'permissions' => [
                    'view_courses',
                    'assign_instructors',
                    'assign_certifiers',
                    'open_qms_cases',
                    'notify_users',
                ],
            ],
            'admin' => [
                'title' => 'Administrator',
                'permissions' => ['*'], // full access
            ],
        ];
    }

    /**
     * Returns all available roles.
     *
     * @return string[]
     */
    public static function getAvailableRoles(): array
    {
        return array_keys(self::getRoleMap());
    }

    /**
     * Returns the permissions for a given role.
     *
     * @param string $role
     * @return string[]
     */
    public static function getPermissionsForRole(string $role): array
    {
        return self::getRoleMap()[$role]['permissions'] ?? [];
    }

    /**
     * Returns the human-readable label for a role.
     *
     * @param string $role
     * @return string
     */
    public static function getRoleTitle(string $role): string
    {
        return self::getRoleMap()[$role]['title'] ?? 'Unknown';
    }
}