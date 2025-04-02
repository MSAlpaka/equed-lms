<?php

return [
    'ctrl' => [
        'title' => 'User Lesson Progress',
        'label' => 'user',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/userlessonprogress.svg',
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
        'lesson' => [
            'label' => 'Lesson',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_equedlms_domain_model_lesson',
                'minitems' => 1,
                'maxitems' => 1,
            ],
        ],
        'completed' => [
            'label' => 'Completed',
            'config' => [
                'type' => 'check',
                'default' => 0,
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
    ],
    'types' => [
        '0' => ['showitem' => 'user, lesson, completed, completion_date'],
    ],
];