<?php
return [
    'ctrl' => [
        'title' => 'QMS Case',
        'label' => 'feedback',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'feedback',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/qms_case.svg',
    ],
    'interface' => [
        'showRecordFieldList' => 'feedback, status',
    ],
    'types' => [
        '1' => ['showitem' => 'feedback, status'],
    ],
    'columns' => [
        'feedback' => [
            'label' => 'Feedback',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_equedlms_domain_model_feedback',
                'maxitems' => 1,
                'minitems' => 1,
            ],
        ],
        'status' => [
            'label' => 'Status',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['Open', 'open'],
                    ['Resolved', 'resolved'],
                ],
            ],
        ],
    ],
];