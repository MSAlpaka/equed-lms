<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_certificate',
        'label' => 'code',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_certificate.svg',
    ],
    'types' => [
        '0' => [
            'showitem' => '
                --div--;Certificate,
                    code, note, issued_at, is_revoked, is_verified,
                --div--;Relations,
                    user_course_record, issued_by
            ',
        ],
    ],
    'columns' => [
        'code' => [
            'label' => 'Certificate Code',
            'config' => [
                'type' => 'input',
                'required' => true,
                'eval' => 'trim',
            ],
        ],
        'note' => [
            'label' => 'Note',
            'config' => [
                'type' => 'text',
                'rows' => 3,
            ],
        ],
        'issued_at' => [
            'label' => 'Issued At',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'is_revoked' => [
            'label' => 'Revoked',
            'config' => ['type' => 'check'],
        ],
        'is_verified' => [
            'label' => 'Verified',
            'config' => ['type' => 'check'],
        ],
        'user_course_record' => [
            'label' => 'User Course Record',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'foreign_table' => 'tx_equedlms_domain_model_usercourserecord',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'issued_by' => [
            'label' => 'Issued By',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'fe_users',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
    ],
];