<?php

return [
    'ctrl' => [
        'title' => 'QMS Case',
        'label' => 'status',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'hideTable' => false,
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_qmscase.svg',
    ],
    'types' => [
        '0' => ['showitem' => '
            --div--;General,
                auditLog, status, createdAt, description, feedback
        '],
    ],
    'columns' => [
        'auditLog' => [
            'label' => 'Audit Log',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_auditlog',
                'size' => 1,
                'maxitems' => 1,
            ],
        ],
        'status' => [
            'label' => 'Status',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['Open', 'open'],
                    ['In Review', 'in_review'],
                    ['Resolved', 'resolved'],
                    ['Closed', 'closed'],
                ],
            ],
        ],
        'createdAt' => [
            'label' => 'Created At',
            'config' => [
                'type' => 'datetime',
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
