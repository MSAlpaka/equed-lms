<?php

return [
    'ctrl' => [
        'title' => 'User Course Record',
        'label' => 'user',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_usercourserecord.svg',
    ],
    'types' => [
        '0' => [
            'showitem' => '
                --div--;Participant,
                    user, course_instance, is_retake, attempt_count,
                --div--;Progress,
                    status, instructor_confirmed, certifier_validated, admin_approved, started_at, completed_at,
                --div--;Feedback,
                    instructor_feedback, note, exam_results,
                --div--;Certificate,
                    certificate_code, certificate_issued_at
            ',
        ],
    ],
    'columns' => [
        'user' => [
            'label' => 'User',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'fe_users',
                'minitems' => 1,
                'maxitems' => 1,
            ],
        ],
        'course_instance' => [
            'label' => 'Course Instance',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_equedlms_domain_model_courseinstance',
                'minitems' => 1,
                'maxitems' => 1,
            ],
        ],
        'status' => [
            'label' => 'Status',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['In Progress', 'in_progress'],
                    ['Completed', 'completed'],
                    ['Failed', 'failed'],
                    ['Withdrawn', 'withdrawn'],
                ],
                'default' => 'in_progress',
            ],
        ],
        'started_at' => [
            'label' => 'Started At',
            'config' => ['type' => 'datetime'],
        ],
        'completed_at' => [
            'label' => 'Completed At',
            'config' => ['type' => 'datetime'],
        ],
        'attempt_count' => [
            'label' => 'Attempt Count',
            'config' => ['type' => 'number'],
        ],
        'is_retake' => [
            'label' => 'Is Retake?',
            'config' => ['type' => 'check'],
        ],
        'instructor_confirmed' => [
            'label' => 'Instructor Confirmed',
            'config' => ['type' => 'check'],
        ],
        'certifier_validated' => [
            'label' => 'Certifier Validated',
            'config' => ['type' => 'check'],
        ],
        'admin_approved' => [
            'label' => 'Admin Approved',
            'config' => ['type' => 'check'],
        ],
        'instructor_feedback' => [
            'label' => 'Instructor Feedback',
            'config' => ['type' => 'text', 'rows' => 4],
        ],
        'note' => [
            'label' => 'Internal Note',
            'config' => ['type' => 'text', 'rows' => 3],
        ],
        'exam_results' => [
            'label' => 'Exam Results',
            'config' => ['type' => 'text', 'rows' => 4],
        ],
        'certificate_code' => [
            'label' => 'Certificate Code',
            'config' => ['type' => 'input'],
        ],
        'certificate_issued_at' => [
            'label' => 'Certificate Issued At',
            'config' => ['type' => 'datetime'],
        ],
    ],
];