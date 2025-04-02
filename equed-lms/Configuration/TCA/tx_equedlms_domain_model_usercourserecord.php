<?php

return [
    'ctrl' => [
        'title' => 'User Course Record',
        'label' => 'user',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/usercourserecord.svg',
    ],
    'columns' => [
        'user' => [
            'label' => 'User',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'foreign_table' => 'fe_users',
                'minitems' => 1,
                'maxitems' => 1,
            ],
        ],
        'course' => [
            'label' => 'Course',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_equedlms_domain_model_course',
                'minitems' => 1,
                'maxitems' => 1,
            ],
        ],
        'status' => [
            'label' => 'Status',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['In Progress', 'in_progress'],
                    ['Completed', 'completed'],
                    ['Validated', 'validated'],
                    ['Rejected', 'rejected'],
                ],
                'default' => 'in_progress',
            ],
        ],
        'completion_date' => [
            'label' => 'Completion Date',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime',
                'default' => null,
            ],
        ],
        'validated' => [
            'label' => 'Validated',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'certifier' => [
            'label' => 'Certifier',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'foreign_table' => 'fe_users',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
    ],
    'types' => [
        '0' => ['showitem' => 'user, course, status, completion_date, validated, certifier'],
    ],
];