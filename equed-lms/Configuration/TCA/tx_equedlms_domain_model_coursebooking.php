<?php

return [
    'ctrl' => [
        'title' => 'Course Booking',
        'label' => 'booking_date',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_coursebooking.svg',
    ],
    'types' => [
        '0' => [
            'showitem' => '
                --div--;General,
                    user, course, booking_date, status, comment
            ',
        ],
    ],
    'columns' => [
        'user' => [
            'label' => 'User',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'fe_users',
                'minitems' => 1,
                'maxitems' => 1,
            ],
        ],
        'course' => [
            'label' => 'Course',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'foreign_table' => 'tx_equedlms_domain_model_course',
                'minitems' => 1,
                'maxitems' => 1,
            ],
        ],
        'booking_date' => [
            'label' => 'Booking Date',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'status' => [
            'label' => 'Status',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['Pending', 'pending'],
                    ['Confirmed', 'confirmed'],
                    ['Rejected', 'rejected'],
                ],
                'default' => 'pending',
            ],
        ],
        'comment' => [
            'label' => 'Comment',
            'config' => [
                'type' => 'text',
                'rows' => 4,
            ],
        ],
    ],
];