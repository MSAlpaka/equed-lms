<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_lesson',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'sortby' => 'position',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_lesson.svg',
    ],
    'types' => [
        '0' => [
            'showitem' => '
                --div--;General,
                    title, slug, description, position, duration_in_minutes, is_required,
                --div--;Relations,
                    course, content_pages, quiz_questions
            ',
        ],
    ],
    'columns' => [
        'title' => [
            'label' => 'Title',
            'config' => [
                'type' => 'input',
                'required' => true,
            ],
        ],
        'slug' => [
            'label' => 'Slug',
            'config' => [
                'type' => 'slug',
                'generatorOptions' => [
                    'fields' => ['title'],
                ],
                'fallbackCharacter' => '-',
                'eval' => 'unique',
            ],
        ],
        'description' => [
            'label' => 'Description',
            'config' => [
                'type' => 'text',
                'rows' => 5,
            ],
        ],
        'position' => [
            'label' => 'Position',
            'config' => [
                'type' => 'number',
                'default' => 0,
            ],
        ],
        'duration_in_minutes' => [
            'label' => 'Duration (in minutes)',
            'config' => [
                'type' => 'number',
                'default' => 0,
            ],
        ],
        'is_required' => [
            'label' => 'Required for Course Completion?',
            'config' => [
                'type' => 'check',
                'default' => 1,
            ],
        ],
        'course' => [
            'label' => 'Course',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_equedlms_domain_model_course',
                'renderType' => 'selectSingle',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'content_pages' => [
            'label' => 'Content Pages',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_equedlms_domain_model_contentpage',
                'foreign_field' => 'lesson',
                'appearance' => [
                    'collapseAll' => true,
                    'useSortable' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
        'quiz_questions' => [
            'label' => 'Quiz Questions',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_equedlms_domain_model_quizquestion',
                'foreign_field' => 'lesson',
                'appearance' => [
                    'collapseAll' => true,
                    'useSortable' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
    ],
];