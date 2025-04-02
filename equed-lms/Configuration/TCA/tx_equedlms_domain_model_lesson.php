<?php

return [
    'ctrl' => [
        'title' => 'Lesson',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'delete' => 'deleted',
        'sortby' => 'position',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/lesson.svg',
    ],
    'types' => [
        '0' => ['showitem' => 'title, slug, position, course, materials, hidden'],
    ],
    'columns' => [
        'hidden' => [
            'label' => 'Visible',
            'config' => [
                'type' => 'check',
                'items' => [
                    ['label' => '', 'value' => 1]
                ],
            ],
        ],
        'title' => [
            'label' => 'Title',
            'config' => [
                'type' => 'input',
                'required' => true,
                'eval' => 'trim',
            ],
        ],
        'slug' => [
            'label' => 'Slug',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ],
        ],
        'position' => [
            'label' => 'Position',
            'config' => [
                'type' => 'number'
            ],
        ],
        'course' => [
            'label' => 'Course',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_course',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1
            ],
        ],
        'materials' => [
            'label' => 'Materials',
            'config' => [
                'type' => 'file',
                'appearance' => [
                    'createNewRelationLinkTitle' => 'Add Material'
                ],
                'maxitems' => 10,
                'uploadFolder' => '1:/user_upload/materials/',
            ],
        ],
    ],
];