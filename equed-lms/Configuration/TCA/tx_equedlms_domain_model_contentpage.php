<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_contentpage',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'sortby' => 'position',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_contentpage.svg',
    ],
    'types' => [
        '0' => [
            'showitem' => '
                --div--;General,
                    title, text, position, is_required,
                --div--;Relations,
                    lesson, quiz_question, media, downloads
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
        'text' => [
            'label' => 'Text',
            'config' => [
                'type' => 'text',
                'rows' => 8,
                'enableRichtext' => true,
            ],
        ],
        'position' => [
            'label' => 'Position',
            'config' => [
                'type' => 'number',
            ],
        ],
        'is_required' => [
            'label' => 'Required for Completion',
            'config' => [
                'type' => 'check',
            ],
        ],
        'lesson' => [
            'label' => 'Lesson',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'foreign_table' => 'tx_equedlms_domain_model_lesson',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'quiz_question' => [
            'label' => 'Quiz Question',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'foreign_table' => 'tx_equedlms_domain_model_quizquestion',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'media' => [
            'label' => 'Media',
            'config' => [
                'type' => 'file',
                'maxitems' => 10,
            ],
        ],
        'downloads' => [
            'label' => 'Downloads',
            'config' => [
                'type' => 'file',
                'maxitems' => 10,
            ],
        ],
    ],
];