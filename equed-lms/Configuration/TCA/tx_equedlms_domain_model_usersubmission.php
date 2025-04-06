<?php

return [
    'ctrl' => [
        'title' => 'User Submission',
        'label' => 'status',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'hideTable' => false,
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_usersubmission.svg',
    ],
    'types' => [
        '0' => ['showitem' => '
            --div--;General,
                feUser, userCourseRecord, lesson, type, status, comment, feedback, files
        '],
    ],
    'columns' => [
        'feUser' => [
            'label' => 'Frontend User',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'size' => 1,
                'maxitems' => 1,
            ],
        ],
        'userCourseRecord' => [
            'label' => 'User Course Record',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_usercourserecord',
                'size' => 1,
                'maxitems' => 1,
            ],
        ],
        'lesson' => [
            'label' => 'Lesson',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_lesson',
                'size' => 1,
                'maxitems' => 1,
            ],
        ],
        'type' => [
            'label' => 'Type',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['Theory Test', 'theory_test'],
                    ['Report', 'report'],
                    ['Practical Case', 'practical_case'],
                ],
            ],
        ],
        'status' => [
            'label' => 'Status',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['Submitted', 'submitted'],
                    ['Approved', 'approved'],
                    ['Rejected', 'rejected'],
                    ['Revision', 'revision'],
                    ['Flagged', 'flagged'],
                ],
            ],
        ],
        'comment' => [
            'label' => 'Comment',
            'config' => [
                'type' => 'text',
                'rows' => 3,
            ],
        ],
        'feedback' => [
            'label' => 'Feedback',
            'config' => [
                'type' => 'text',
                'rows' => 3,
            ],
        ],
        'files' => [
            'label' => 'Files',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'sys_file',
                'foreign_field' => 'uid',
                'maxitems' => 5,
                'appearance' => [
                    'useSortable' => true,
                    'showPossible' => true,
                    'showAll' => true,
                ],
            ],
        ],
    ],
];
