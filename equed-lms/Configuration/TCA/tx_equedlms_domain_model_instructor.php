<?php

return [
    'ctrl' => [
        'title' => 'Instructor',
        'label' => 'user',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'hideTable' => false,
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_instructor.svg',
    ],
    'types' => [
        '0' => ['showitem' => '
            --div--;General,
                user, image, bio, specialties, verified, level, active
        '],
    ],
    'columns' => [
        'user' => [
            'label' => 'User',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'size' => 1,
                'maxitems' => 1,
            ],
        ],
        'image' => [
            'label' => 'Image',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'sys_file',
                'foreign_field' => 'uid',
                'maxitems' => 1,
                'appearance' => [
                    'useSortable' => true,
                    'showPossible' => true,
                    'showAll' => true,
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
            ],
        ],
        'verified' => [
            'label' => 'Verified',
            'config' => [
                'type' => 'check',
            ],
        ],
        'level' => [
            'label' => 'Level',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['Basic', 'basic'],
                    ['Senior', 'senior'],
                    ['Lead', 'lead'],
                ],
            ],
        ],
        'active' => [
            'label' => 'Active',
            'config' => [
                'type' => 'check',
            ],
        ],
    ],
];
