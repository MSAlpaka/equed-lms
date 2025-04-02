<?php

return [
    'ctrl' => [
        'title' => 'Content Page',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/contentpage.svg',
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
        'course' => [
            'label' => 'Course (optional)',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_equedlms_domain_model_course',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'lesson' => [
            'label' => 'Lesson (optional)',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_equedlms_domain_model_lesson',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'sorting' => [
            'label' => 'Sorting',
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
        'attachments' => [
            'label' => 'Attachments',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'sys_file_reference',
                'foreign_field' => 'uid_foreign',
                'foreign_sortby' => 'sorting_foreign',
                'foreign_table_field' => 'tablenames',
                'foreign_match_fields' => [
                    'fieldname' => 'attachments',
                ],
                'appearance' => [
                    'createNewRelationLinkTitle' => 'Add Attachment',
                    'showPossibleLocalizationRecords' => true,
                    'showRemovedLocalizationRecords' => false,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
    ],
    'types' => [
        '0' => ['showitem' =>
            'title, content, course, lesson, sorting, visible, attachments'],
    ],
];