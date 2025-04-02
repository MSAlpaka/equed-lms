<?php

return [
    'ctrl' => [
        'title' => 'Lesson',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/lesson.svg',
    ],
    'columns' => [
        'title' => [
            'label' => 'Title',
            'config' => [
                'type' => 'input',
                'required' => true,
            ],
        ],
        'content' => [
            'label' => 'Content',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
            ],
        ],
        'sort_order' => [
            'label' => 'Sort Order',
            'config' => [
                'type' => 'input',
                'eval' => 'int',
                'default' => 0,
            ],
        ],
        'estimated_time' => [
            'label' => 'Estimated Time (minutes)',
            'config' => [
                'type' => 'input',
                'eval' => 'int',
                'default' => 0,
            ],
        ],
        'required' => [
            'label' => 'Required Lesson',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'visible' => [
            'label' => 'Visible',
            'config' => [
                'type' => 'check',
                'default' => 1,
            ],
        ],
        'course' => [
            'label' => 'Course',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_equedlms_domain_model_course',
                'minitems' => 1,
                'maxitems' => 1,
            ],
        ],
        'media_files' => [
            'label' => 'Media Files',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'sys_file_reference',
                'foreign_field' => 'uid_foreign',
                'foreign_sortby' => 'sorting_foreign',
                'foreign_table_field' => 'tablenames',
                'foreign_match_fields' => [
                    'fieldname' => 'media_files',
                ],
                'appearance' => [
                    'createNewRelationLinkTitle' => 'Add File',
                ],
            ],
        ],
    ],
    'types' => [
        '0' => ['showitem' => 'title, course, sort_order, required, visible, estimated_time, content, media_files'],
    ],
];