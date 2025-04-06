<?php

return [
    'ctrl' => [
        'title' => 'Content Page',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'hideTable' => false,
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_contentpage.svg',
    ],
    'types' => [
        '0' => ['showitem' => '
            --div--;General,
                title, text, position, lesson, isRequired, quizQuestion, media, downloads
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
        'text' => [
            'label' => 'Text',
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
        'lesson' => [
            'label' => 'Lesson',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_lesson',
                'size' => 1,
                'maxitems' => 1,
            ],
        ],
        'isRequired' => [
            'label' => 'Is Required',
            'config' => [
                'type' => 'check',
            ],
        ],
        'quizQuestion' => [
            'label' => 'Quiz Question',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_quizquestion',
                'size' => 1,
                'maxitems' => 1,
            ],
        ],
        'media' => [
            'label' => 'Media',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'sys_file',
                'foreign_field' => 'uid',
                'maxitems' => 10,
                'appearance' => [
                    'useSortable' => true,
                    'showPossible' => true,
                    'showAll' => true,
                ],
            ],
        ],
        'downloads' => [
            'label' => 'Downloads',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'sys_file',
                'foreign_field' => 'uid',
                'maxitems' => 10,
                'appearance' => [
                    'useSortable' => true,
                    'showPossible' => true,
                    'showAll' => true,
                ],
            ],
        ],
    ],
];
