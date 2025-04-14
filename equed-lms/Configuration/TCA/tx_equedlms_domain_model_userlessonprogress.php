<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_userlessonprogress',
        'label' => 'lesson',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_userlessonprogress.svg',
    ],
    'types' => [
        '0' => [
            'showitem' => '
                --div--;General,
                    fe_user, lesson, confirmed, completed, quiz_score, progress_percent,
                --div--;Time Tracking,
                    started_at, completed_at, last_visited_at, time_spent_in_seconds
            ',
        ],
    ],
    'columns' => [
        'fe_user' => [
            'label' => 'Frontend User',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'fe_users',
                'renderType' => 'selectSingle',
                'minitems' => 1,
                'maxitems' => 1,
            ],
        ],
        'lesson' => [
            'label' => 'Lesson',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_equedlms_domain_model_lesson',
                'renderType' => 'selectSingle',
                'minitems' => 1,
                'maxitems' => 1,
            ],
        ],
        'confirmed' => [
            'label' => 'Confirmed by Instructor?',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'completed' => [
            'label' => 'Lesson Completed?',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'quiz_score' => [
            'label' => 'Quiz Score (%)',
            'config' => [
                'type' => 'number',
                'default' => 0,
            ],
        ],
        'progress_percent' => [
            'label' => 'Progress (%)',
            'config' => [
                'type' => 'number',
                'default' => 0,
            ],
        ],
        'started_at' => [
            'label' => 'Started At',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime',
            ],
        ],
        'completed_at' => [
            'label' => 'Completed At',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime',
            ],
        ],
        'last_visited_at' => [
            'label' => 'Last Visited At',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime',
            ],
        ],
        'time_spent_in_seconds' => [
            'label' => 'Time Spent (seconds)',
            'config' => [
                'type' => 'number',
                'default' => 0,
            ],
        ],
    ],
];