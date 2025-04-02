<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_quizanswer.title',
        'label' => 'answer_text',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/quizanswer.svg'
    ],
    'columns' => [
        'answer_text' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_quizanswer.answer_text',
            'config' => [
                'type' => 'text',
                'rows' => 3
            ]
        ],
        'is_correct' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_quizanswer.is_correct',
            'config' => [
                'type' => 'check',
                'default' => 0
            ]
        ],
        'question' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_quizanswer.question',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_equedlms_domain_model_quizquestion',
                'minItems' => 0,
                'maxItems' => 1
            ]
        ]
    ],
    'types' => [
        '0' => [
            'showitem' => 'answer_text, is_correct, question'
        ]
    ]
];