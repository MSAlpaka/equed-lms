<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_quizquestion.title',
        'label' => 'question_text',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/quizquestion.svg'
    ],
    'columns' => [
        'question_text' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_quizquestion.question_text',
            'config' => [
                'type' => 'text',
                'rows' => 4
            ]
        ],
        'lesson' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_quizquestion.lesson',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_equedlms_domain_model_lesson',
                'minItems' => 0,
                'maxItems' => 1
            ]
        ],
        'answers' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_quizquestion.answers',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_equedlms_domain_model_quizanswer',
                'foreign_field' => 'question',
                'maxItems' => 100
            ]
        ]
    ],
    'types' => [
        '0' => [
            'showitem' => 'question_text, lesson, answers'
        ]
    ]
];