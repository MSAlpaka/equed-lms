<?php

return [
    'ctrl' => [
        'title' => 'Audit Log',
        'label' => 'action',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/auditlog.svg',
    ],
    'columns' => [
        'fe_user' => [
            'label' => 'User',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'foreign_table' => 'fe_users',
                'minitems' => 0,
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
                'type' => 'input',
                'eval' => 'int',
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
                'enableRichtext' => false,
            ],
        ],
        'timestamp' => [
            'label' => 'Timestamp',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime',
                'default' => null,
            ],
        ],
    ],
    'types' => [
        '0' => ['showitem' => 'fe_user, action, related_id, related_type, comment, timestamp'],
    ],
];