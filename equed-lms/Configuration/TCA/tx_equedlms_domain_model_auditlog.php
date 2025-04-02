<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_auditlog',
        'label' => 'action',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        'rootLevel' => 0,
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/auditlog.svg',
    ],
    'types' => [
        '0' => ['showitem' => 'fe_user, action, related_type, related_id, timestamp, comment'],
    ],
    'columns' => [
        'fe_user' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_auditlog.fe_user',
            'config' => [
                'type' => 'input',
                'eval' => 'int',
                'readOnly' => true,
            ],
        ],
        'action' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_auditlog.action',
            'config' => [
                'type' => 'input',
                'required' => true,
                'eval' => 'trim',
            ],
        ],
        'related_id' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_auditlog.related_id',
            'config' => [
                'type' => 'input',
                'eval' => 'int',
            ],
        ],
        'related_type' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_auditlog.related_type',
            'config' => [
                'type' => 'input',
            ],
        ],
        'timestamp' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_auditlog.timestamp',
            'config' => [
                'type' => 'datetime',
                'readOnly' => true,
            ],
        ],
        'comment' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_auditlog.comment',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 3,
            ],
        ],
    ],
];