<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:certificate',
        'label' => 'code',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'code,note',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/certificate.svg',
    ],
    'types' => [
        '1' => ['showitem' => 'code, user_course_record, issued_by, issued_at, is_revoked, note'],
    ],
    'columns' => [
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
            ],
        ],
        'code' => [
            'exclude' => false,
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:certificate.code',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,required',
            ],
        ],
        'user_course_record' => [
            'exclude' => true,
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:certificate.user_course_record',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_equedlms_domain_model_usercourserecord',
                'minitems' => 1,
                'maxitems' => 1,
            ],
        ],
        'issued_by' => [
            'exclude' => true,
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:certificate.issued_by',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'size' => 1,
                'maxitems' => 1,
                'minitems' => 0,
            ],
        ],
        'issued_at' => [
            'exclude' => true,
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:certificate.issued_at',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'datetime',
            ],
        ],
        'is_revoked' => [
            'exclude' => true,
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:certificate.is_revoked',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'note' => [
            'exclude' => true,
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:certificate.note',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 3,
            ],
        ],
    ],
];