<?php

return [
    'ctrl' => [
        'title' => 'Audit Log Entry',
        'label' => 'action',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'hideTable' => false,
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_auditlog.svg',
    ],
    'types' => [
        '0' => ['showitem' => '
            --div--;General,
                fe_user, action, related_id, related_type, comment, timestamp
        '],
    ],
    'columns' => [
        'fe_user' => [
            'label' => 'Frontend User',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'size' => 1,
                'maxitems' => 1,
            ],
        ],
        'action' => [
            'label' => 'Action',
            'config' => [
                'type' => 'input',
                'required' => true,
            ],
        ],
        'related_id' => [
            'label' => 'Related ID',
            'config' => [
                'type' => 'number',
            ],
        ],
        'related_type' => [
            'label' => 'Related Type',
            'config' => [
                'type' => 'input',
            ],
        ],
        'comment' => [
            'label' => 'Comment',
            'config' => [
                'type' => 'text',
                'rows' => 3,
            ],
        ],
        'timestamp' => [
            'label' => 'Timestamp',
            'config' => [
                'type' => 'datetime',
            ],
        ],
    ],
];
