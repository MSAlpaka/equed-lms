<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_auditlog',
        'label' => 'action',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_auditlog.svg',
    ],
    'types' => [
        '0' => [
            'showitem' => '
                --div--;General,
                    fe_user, action, comment,
                --div--;Context,
                    related_type, related_id, timestamp
            ',
        ],
    ],
    'columns' => [
        'fe_user' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.fe_user',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'fe_users',
                'minitems' => 1,
                'maxitems' => 1,
            ],
        ],
        'action' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_auditlog.action',
            'config' => [
                'type' => 'input',
                'required' => true,
            ],
        ],
        'comment' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.comment',
            'config' => [
                'type' => 'text',
                'rows' => 4,
            ],
        ],
        'related_id' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_auditlog.related_id',
            'config' => [
                'type' => 'number',
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
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime',
                'default' => time(),
            ],
        ],
    ],
];