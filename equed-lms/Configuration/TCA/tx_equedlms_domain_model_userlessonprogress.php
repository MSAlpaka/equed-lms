<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_userlessonprogress.title',
        'label' => 'uid',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'readOnly' => true,
        'hideTable' => true,
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/userlessonprogress.svg'
    ],
    'columns' => [
        'fe_user' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_userlessonprogress.fe_user',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'fe_users',
                'minItems' => 0,
                'maxItems' => 1
            ]
        ],
        'lesson' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_userlessonprogress.lesson',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_equedlms_domain_model_lesson',
                'minItems' => 0,
                'maxItems' => 1
            ]
        ],
        'completed' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_userlessonprogress.completed',
            'config' => [
                'type' => 'check',
                'default' => 0
            ]
        ],
        'completion_date' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_userlessonprogress.completion_date',
            'config' => [
                'type' => 'datetime'
            ]
        ]
    ],
    'types' => [
        '0' => [
            'showitem' => 'fe_user, lesson, completed, completion_date'
        ]
    ]
];