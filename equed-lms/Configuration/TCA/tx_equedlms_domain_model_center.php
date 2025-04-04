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
        'street' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_center.street',
            'config' => ['type' => 'input']
        ],
        'zip' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_center.zip',
            'config' => ['type' => 'input']
        ],
        'city' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_center.city',
            'config' => ['type' => 'input']
        ],
        'website' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_center.website',
            'config' => ['type' => 'input']
        ],
        'center_id' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_center.center_id',
            'config' => ['type' => 'input']
        ],
        'logo' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_center.logo',
            'config' => [
                'type' => 'file',
                'appearance' => [
                    'createNewRelationLinkTitle' => 'LLL:EXT:core/Resources/Private/Language/locallang_core.xlf:cm.createNewRelation'
                ],
                'allowed' => 'jpg,jpeg,png,svg',
                'maxitems' => 1
            ]
        ],
        'certifier' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_center.certifier',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'maxitems' => 1,
            ]
        ],
    ],
    'types' => [
        '1' => ['showitem' => 'name, street, zip, city, website, center_id, logo, certifier'],
    ],
];