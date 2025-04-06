<?php

return [
    'ctrl' => [
        'title' => 'Badge',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'hideTable' => false,
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_badge.svg',
    ],
    'types' => [
        '0' => ['showitem' => '
            --div--;General,
                name, description, assignmentType, relatedCourse, relatedLesson, recipients
        '],
    ],
    'columns' => [
        'name' => [
            'label' => 'Name',
            'config' => [
                'type' => 'input',
                'required' => true,
            ],
        ],
        'description' => [
            'label' => 'Description',
            'config' => [
                'type' => 'text',
                'rows' => 3,
            ],
        ],
        'assignmentType' => [
            'label' => 'Assignment Type',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['manual', 'manual'],
                    ['automatic', 'automatic'],
                ],
            ],
        ],
        'relatedCourse' => [
            'label' => 'Related Course',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_course',
                'size' => 1,
                'maxitems' => 1,
            ],
        ],
        'relatedLesson' => [
            'label' => 'Related Lesson',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_lesson',
                'size' => 1,
                'maxitems' => 1,
            ],
        ],
        'recipients' => [
            'label' => 'Recipients',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'size' => 10,
                'maxitems' => 100,
            ],
        ],
    ],
];
