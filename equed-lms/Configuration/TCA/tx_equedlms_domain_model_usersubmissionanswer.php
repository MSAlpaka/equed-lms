<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_usersubmissionanswer',
        'label' => 'quiz_answer',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_usersubmissionanswer.svg',
    ],
    'types' => [
        '0' => [
            'showitem' => '
                --div--;General,
                    user_submission, quiz_answer, given_answer, is_correct, feedback
            ',
        ],
    ],
    'columns' => [
        'user_submission' => [
            'label' => 'User Submission',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_equedlms_domain_model_usersubmission',
                'renderType' => 'selectSingle',
                'minitems' => 1,
                'maxitems' => 1,
            ],
        ],
        'quiz_answer' => [
            'label' => 'Quiz Answer',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_equedlms_domain_model_quizanswer',
                'renderType' => 'selectSingle',
                'minitems' => 1,
                'maxitems' => 1,
            ],
        ],
        'given_answer' => [
            'label' => 'Given Answer',
            'config' => [
                'type' => 'text',
                'rows' => 3,
            ],
        ],
        'is_correct' => [
            'label' => 'Correct?',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'feedback' => [
            'label' => 'Instructor Feedback',
            'config' => [
                'type' => 'text',
                'rows' => 3,
            ],
        ],
    ],
];