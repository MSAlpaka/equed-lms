<?php

return [
    'ctrl' => [
        'title' => 'Lesson',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'hideTable' => false,
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_lesson.svg',
    ],
    'types' => [
        '0' => ['showitem' => '
            --div--;General,
                title, slug, description, position, durationInMinutes, isRequired, course, contentPages, quizQuestions
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
        'slug' => [
            'label' => 'Slug',
            'config' => [
                'type' => 'input',
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
                'type' => 'input',
                'eval' => 'int',
            ],
        ],
        'durationInMinutes' => [
            'label' => 'Duration (in minutes)',
            'config' => [
                'type' => 'input',
                'eval' => 'int',
            ],
        ],
        'isRequired' => [
            'label' => 'Is Required',
            'config' => [
                'type' => 'check',
            ],
        ],
        'course' => [
            'label' => 'Course',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_course',
                'size' => 1,
                'maxitems' => 1,
            ],
        ],
        'contentPages' => [
            'label' => 'Content Pages',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_contentpage',
                'size' => 10,
                'maxitems' => 50,
            ],
        ],
        'quizQuestions' => [
            'label' => 'Quiz Questions',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_quizquestion',
                'size' => 10,
                'maxitems' => 50,
            ],
        ],
    ],
];
