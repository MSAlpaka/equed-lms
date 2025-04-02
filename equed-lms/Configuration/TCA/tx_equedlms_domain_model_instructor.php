<?php

return [
    'ctrl' => [
        'title' => 'Instructor',
        'label' => 'user',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/instructor.svg',
    ],
    'columns' => [
        'user' => [
            'label' => 'Frontend User',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'foreign_table' => 'fe_users',
                'minitems' => 1,
                'maxitems' => 1,
            ],
        ],
        'bio' => [
            'label' => 'Bio',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
            ],
        ],
        'specialties' => [
            'label' => 'Specialties (comma-separated)',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ],
        ],
        'verified' => [
            'label' => 'Verified',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
    ],
    'types' => [
        '0' => ['showitem' => 'user, specialties, verified, bio'],
    ],
];