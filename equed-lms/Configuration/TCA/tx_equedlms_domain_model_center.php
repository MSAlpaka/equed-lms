<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_center.title',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/center.svg'
    ],
    'columns' => [
        'name' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_center.name',
            'config' => [
                'type' => 'input',
                'required' => true
            ]
        ],
        'location' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_center.location',
            'config' => [
                'type' => 'input'
            ]
        ],
        'contact_email' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_center.contact_email',
            'config' => [
                'type' => 'input',
                'eval' => 'email'
            ]
        ],
        'active' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_center.active',
            'config' => [
                'type' => 'check',
                'default' => 1
            ]
        ]
    ],
    'types' => [
        '0' => [
            'showitem' => 'name, location, contact_email, active'
        ]
    ],
    'certifier' => [
    'exclude' => 0,
    'label' => 'Zuständiger Certifier (FE User)',
    'config' => [
        'type' => 'group',
        'internal_type' => 'db',
        'allowed' => 'fe_users',
        'foreign_table' => 'fe_users',
        'minitems' => 0,
        'maxitems' => 1,
    ],
],
];