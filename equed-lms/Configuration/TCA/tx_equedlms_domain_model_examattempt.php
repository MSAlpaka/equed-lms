<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_examattempt',
        'label' => 'attempt_number',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_examattempt.svg',
    ],
    'types' => [
        '0' => [
            'showitem' => '
                --div--;General,
                    user, quiz_question, given_answer, correct, attempt_number, mode, feedback, timestamp
            ',
        ],
    ],
    'columns' => [
        'user' => [
            'label' => 'User',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'fe_users',
                'renderType' => 'selectSingle',
                'minitems' => 1,
                'maxitems' => 1,
            ],
        ],
        'quiz_question' => [
            'label' => 'Quiz Question',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_equedlms_domain_model_quizquestion',
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
        'correct' => [
            'label' => 'Correct?',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'attempt_number' => [
            'label' => 'Attempt Number',
            'config' => [
                'type' => 'number',
                'default' => 1,
            ],
        ],
        'mode' => [
            'label' => 'Mode',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['Standard', 'standard'],
                    ['Review', 'review'],
                    ['Repeat', 'repeat'],
                ],
                'renderType' => 'selectSingle',
                'default' => 'standard',
            ],
        ],
        'feedback' => [
            'label' => 'Feedback',
            'config' => [
                'type' => 'text',
                'rows' => 3,
            ],
        ],
        'timestamp' => [
            'label' => 'Timestamp',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime',
                'default' => time(),
            ],
        ],
    ],
];