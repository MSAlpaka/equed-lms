<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_quizanswer.title',
        'label' => 'answer_text',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'delete' => 'deleted',
        'hideTable' => true,
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/quizanswer.svg'
    ],
    'columns' => [
        'answer_text' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_quizanswer.answer_text',
            'config' => [
                'type' => 'input',
                'required' => true,
            ]
        ],
        'is_correct' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.correct',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ]
        ],
        'question' => [
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_equedlms_domain_model_quizquestion',
                'maxItems' => 1,
                'default' => 0,
            ]
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => 'answer_text, is_correct'
        ],
    ],
];