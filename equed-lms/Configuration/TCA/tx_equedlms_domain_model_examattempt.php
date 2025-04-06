<?php

return [
    'ctrl' => [
        'title' => 'Exam Attempt',
        'label' => 'quizQuestion',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'hideTable' => false,
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_examattempt.svg',
    ],
    'types' => [
        '0' => ['showitem' => '
            --div--;General,
                user, quizQuestion, givenAnswer, correct, timestamp, attemptNumber, mode, feedback
        '],
    ],
    'columns' => [
        'user' => [
            'label' => 'User',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'size' => 1,
                'maxitems' => 1,
            ],
        ],
        'quizQuestion' => [
            'label' => 'Quiz Question',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_quizquestion',
                'size' => 1,
                'maxitems' => 1,
            ],
        ],
        'givenAnswer' => [
            'label' => 'Given Answer',
            'config' => [
                'type' => 'text',
                'rows' => 3,
            ],
        ],
        'correct' => [
            'label' => 'Correct',
            'config' => [
                'type' => 'check',
            ],
        ],
        'timestamp' => [
            'label' => 'Timestamp',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'attemptNumber' => [
            'label' => 'Attempt Number',
            'config' => [
                'type' => 'input',
                'eval' => 'int',
            ],
        ],
        'mode' => [
            'label' => 'Mode',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['Practice', 'practice'],
                    ['Final', 'final'],
                ],
            ],
        ],
        'feedback' => [
            'label' => 'Feedback',
            'config' => [
                'type' => 'text',
                'rows' => 3,
            ],
        ],
    ],
];
