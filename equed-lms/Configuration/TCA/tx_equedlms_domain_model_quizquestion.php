<?php

return [
    'ctrl' => [
        'title' => 'Quiz Question',
        'label' => 'question_text',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/quizquestion.svg',
    ],
    'columns' => [
        'question_text' => [
            'label' => 'Question Text',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'rows' => 4,
            ],
        ],
        'type' => [
            'label' => 'Question Type',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['Single Choice', 'single'],
                    ['Multiple Choice', 'multiple'],
                    ['True/False', 'truefalse'],
                ],
                'default' => 'single',
            ],
        ],
        'required' => [
            'label' => 'Required',
            'config' => [
                'type' => 'check',
                'default' => 1,
            ],
        ],
        'points' => [
            'label' => 'Points',
            'config' => [
                'type' => 'input',
                'eval' => 'int',
                'default' => 1,
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
        'answers' => [
            'label' => 'Answers',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_equedlms_domain_model_quizanswer',
                'foreign_field' => 'question',
                'appearance' => [
                    'collapseAll' => 1,
                    'useSortable' => true,
                    'showSynchronizationLink' => true,
                    'showAllLocalizationLink' => true,
                    'showPossibleLocalizationRecords' => true,
                ],
            ],
        ],
    ],
    'types' => [
        '0' => ['showitem' =>
            'question_text, type, required, points, lesson, course, answers'],
    ],
];