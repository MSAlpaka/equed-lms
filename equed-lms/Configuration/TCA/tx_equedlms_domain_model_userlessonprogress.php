<?php

return [
    'ctrl' => [
        'title' => 'User Lesson Progress',
        'label' => 'lesson',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'hideTable' => false,
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_userlessonprogress.svg',
    ],
    'types' => [
        '0' => ['showitem' => '
            --div--;General,
                feUser, lesson, confirmed, quizScore, completed, progressPercent, startedAt, completedAt, lastVisitedAt, timeSpentInSeconds
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
        'confirmed' => [
            'label' => 'Confirmed',
            'config' => [
                'type' => 'check',
            ],
        ],
        'quizScore' => [
            'label' => 'Quiz Score',
            'config' => [
                'type' => 'input',
                'eval' => 'double2',
            ],
        ],
        'completed' => [
            'label' => 'Completed',
            'config' => [
                'type' => 'check',
            ],
        ],
        'progressPercent' => [
            'label' => 'Progress Percent',
            'config' => [
                'type' => 'input',
                'eval' => 'double2',
            ],
        ],
        'startedAt' => [
            'label' => 'Started At',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'completedAt' => [
            'label' => 'Completed At',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'lastVisitedAt' => [
            'label' => 'Last Visited At',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'timeSpentInSeconds' => [
            'label' => 'Time Spent (in seconds)',
            'config' => [
                'type' => 'input',
                'eval' => 'int',
            ],
        ],
    ],
];
