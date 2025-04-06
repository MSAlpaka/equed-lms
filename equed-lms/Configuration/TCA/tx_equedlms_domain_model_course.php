<?php

return [
    'ctrl' => [
        'title' => 'Course',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'hideTable' => false,
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_course.svg',
    ],
    'types' => [
        '0' => ['showitem' => '
            --div--;General,
                title, description, category, finishGoal, prerequisites, image, center
        '],
    ],
    'columns' => [
        'title' => [
            'label' => 'Title',
            'config' => [
                'type' => 'input',
                'required' => true,
            ],
        ],
        'description' => [
            'label' => 'Description',
            'config' => [
                'type' => 'text',
                'rows' => 5,
            ],
        ],
        'category' => [
            'label' => 'Category',
            'config' => [
                'type' => 'input',
            ],
        ],
        'finishGoal' => [
            'label' => 'Finish Goal',
            'config' => [
                'type' => 'input',
            ],
        ],
        'prerequisites' => [
            'label' => 'Prerequisites',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
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
        'center' => [
            'label' => 'Center',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_center',
                'size' => 1,
                'maxitems' => 1,
            ],
        ],
    ],
];
