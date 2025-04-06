<?php

return [
    'ctrl' => [
        'title' => 'User Submission Answer',
        'label' => 'givenAnswer',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'hideTable' => false,
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_usersubmissionanswer.svg',
    ],
    'types' => [
        '0' => ['showitem' => '
            --div--;General,
                userSubmission, quizAnswer, givenAnswer, isCorrect, feedback
        '],
    ],
    'columns' => [
        'userSubmission' => [
            'label' => 'User Submission',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_usersubmission',
                'size' => 1,
                'maxitems' => 1,
            ],
        ],
        'quizAnswer' => [
            'label' => 'Quiz Answer',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_quizanswer',
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
        'isCorrect' => [
            'label' => 'Is Correct',
            'config' => [
                'type' => 'check',
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
