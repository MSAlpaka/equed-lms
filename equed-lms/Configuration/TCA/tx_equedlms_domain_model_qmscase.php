<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_qmscase',
        'label' => 'status',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_qmscase.svg',
    ],
    'types' => [
        '0' => [
            'showitem' => '
                --div--;General,
                    audit_log, status, created_at,
                --div--;Feedback,
                    description, feedback
            ',
        ],
    ],
    'columns' => [
        'audit_log' => [
            'label' => 'Audit Log Entry',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_equedlms_domain_model_auditlog',
                'renderType' => 'selectSingle',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'status' => [
            'label' => 'Status',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['Open', 'open'],
                    ['In Review', 'in_review'],
                    ['Closed', 'closed'],
                ],
                'default' => 'open',
            ],
        ],
        'created_at' => [
            'label' => 'Created At',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime',
                'default' => time(),
            ],
        ],
        'description' => [
            'label' => 'Description',
            'config' => [
                'type' => 'text',
                'rows' => 5,
            ],
        ],
        'feedback' => [
            'label' => 'Feedback',
            'config' => [
                'type' => 'text',
                'rows' => 5,
            ],
        ],
    ],
];