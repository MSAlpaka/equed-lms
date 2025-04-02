<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_contentpage.title',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/contentpage.svg'
    ],
    'columns' => [
        'title' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_contentpage.title',
            'config' => [
                'type' => 'input',
                'required' => true
            ]
        ],
        'bodytext' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_contentpage.bodytext',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'rows' => 10
            ]
        ],
        'lesson' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_contentpage.lesson',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_equedlms_domain_model_lesson',
                'minItems' => 0,
                'maxItems' => 1
            ]
        ],
        'sort_order' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_contentpage.sort_order',
            'config' => [
                'type' => 'number',
                'default' => 0
            ]
        ]
    ],
    'types' => [
        '0' => [
            'showitem' => 'title, bodytext, lesson, sort_order'
        ]
    ]
];