<?php

return [
    'ctrl' => [
        'title' => 'Exam Attempt',
        'label' => 'user',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/examattempt.svg',
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
        'quiz_question' => [
            'label' => 'Quiz Question',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_equedlms_domain_model_quizquestion',
                'minitems' => 1,
                'maxitems' => 1,
            ],
        ],
        'given_answer' => [
            'label' => 'Given Answer',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ],
        ],
        'correct' => [
            'label' => 'Correct?',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'timestamp' => [
            'label' => 'Timestamp',
            'config' => [
                'type' => 'input',
                'type' => 'datetime',
                'eval' => 'datetime',
                'default' => null,
            ],
        ],
    ],
    'types' => [
        '0' => ['showitem' => 'user, quiz_question, given_answer, correct, timestamp'],
    ],
];