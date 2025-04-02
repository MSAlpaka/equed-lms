<?php

return [
    'ctrl' => [
        'title' => 'Course',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/course.svg',
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
                'enableRichtext' => true,
            ],
        ],
        'category' => [
            'label' => 'Category',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['-- Select Category --', ''],
                    ['Basic', 'basic'],
                    ['Specialist', 'specialist'],
                    ['Instructor', 'instructor'],
                    ['Techniques', 'techniques'],
                    ['Try HoofCare', 'try'],
                ],
            ],
        ],
        'course_code' => [
            'label' => 'Course Code',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,alphanum',
            ],
        ],
        'prerequisites' => [
            'label' => 'Prerequisites',
            'config' => [
                'type' => 'text',
                'rows' => 3,
            ],
        ],
        'duration_hours' => [
            'label' => 'Duration (in hours)',
            'config' => [
                'type' => 'input',
                'eval' => 'int',
            ],
        ],
        'visible' => [
            'label' => 'Visible',
            'config' => [
                'type' => 'check',
                'default' => 1,
            ],
        ],
        'requires_external_examiner' => [
            'label' => 'Requires External Examiner',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'active' => [
            'label' => 'Active',
            'config' => [
                'type' => 'check',
                'default' => 1,
            ],
        ],
        'center' => [
            'label' => 'Offered by Center',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_equedlms_domain_model_center',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
    ],
    'types' => [
        '0' => ['showitem' =>
            'title, category, course_code, description, prerequisites, duration_hours, center, visible, active, requires_external_examiner'],
    ],
];