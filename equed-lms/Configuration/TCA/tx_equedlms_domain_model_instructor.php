<?php

return [
    'ctrl' => [
        'title' => 'Instructor',
        'label' => 'user',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_instructor.svg',
    ],
    'types' => [
        '0' => [
            'showitem' => '
                --div--;General,
                    user, image, bio, level, specialties, verified,
                --div--;Availability,
                    can_co_teach, available_for_booking, active_since,
                --div--;Relations,
                    center
            ',
        ],
    ],
    'columns' => [
        'user' => [
            'label' => 'User (FE)',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'fe_users',
                'minitems' => 1,
                'maxitems' => 1,
            ],
        ],
        'image' => [
            'label' => 'Image',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'sys_file_reference',
                'foreign_field' => 'uid_foreign',
                'foreign_sortby' => 'sorting_foreign',
                'foreign_table_field' => 'tablenames',
                'foreign_match_fields' => [
                    'fieldname' => 'image',
                ],
                'appearance' => [
                    'collapseAll' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showRemovedLocalizationRecords' => false,
                    'showSynchronizationLink' => true,
                    'useSortable' => true,
                ],
            ],
        ],
        'bio' => [
            'label' => 'Bio',
            'config' => [
                'type' => 'text',
                'rows' => 5,
            ],
        ],
        'specialties' => [
            'label' => 'Specialties',
            'config' => [
                'type' => 'input',
                'placeholder' => 'donkey,transition,rehab',
            ],
        ],
        'verified' => [
            'label' => 'Verified',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'level' => [
            'label' => 'Level',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['Basic', 'basic'],
                    ['Senior', 'senior'],
                    ['Lead', 'lead'],
                ],
                'default' => 'basic',
            ],
        ],
        'can_co_teach' => [
            'label' => 'Can Co-Teach',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'available_for_booking' => [
            'label' => 'Available for Booking',
            'config' => [
                'type' => 'check',
                'default' => 1,
            ],
        ],
        'active_since' => [
            'label' => 'Active Since',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime',
            ],
        ],
        'center' => [
            'label' => 'Assigned Center',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_equedlms_domain_model_center',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
    ],
];