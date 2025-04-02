<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_badge.title',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/badge.svg'
    ],
    'columns' => [
        'name' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_badge.name',
            'config' => [
                'type' => 'input',
                'required' => true
            ]
        ],
        'description' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_badge.description',
            'config' => [
                'type' => 'text',
                'rows' => 4
            ]
        ],
        'image' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_badge.image',
            'config' => [
                'type' => 'file',
                'appearance' => [
                    'createNewRelationLinkTitle' => 'Add File Reference'
                ],
                'maxitems' => 1
            ]
        ]
    ],
    'types' => [
        '0' => [
            'showitem' => 'name, description, image'
        ]
    ]
];