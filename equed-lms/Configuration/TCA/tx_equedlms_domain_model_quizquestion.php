<?php

return [
    'ctrl' => [
        'title' => 'Quiz Question',
        'label' => 'question_text',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_quizquestion.svg',
    ],
    'types' => [
        '0' => [
            'showitem' => '
                --div--;Question,
                    question_text, explanation, type, score, difficulty, position, required, hidden, image,
                --div--;Relations,
                    lesson, answers
            ',
        ],
    ],
    'columns' => [
        'question_text' => [
            'label' => 'Question Text',
            'config' => ['type' => 'text', 'rows' => 5],
        ],
        'explanation' => [
            'label' => 'Explanation',
            'config' => ['type' => 'text', 'rows' => 3],
        ],
        'type' => [
            'label' => 'Question Type',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['Single Choice', 'single'],
                    ['Multiple Choice', 'multiple'],
                    ['Text Input', 'text'],
                ],
                'default' => 'single',
            ],
        ],
        'score' => [
            'label' => 'Score',
            'config' => ['type' => 'number'],
        ],
        'difficulty' => [
            'label' => 'Difficulty',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['Easy', 'easy'],
                    ['Medium', 'medium'],
                    ['Hard', 'hard'],
                ],
                'default' => 'medium',
            ],
        ],
        'position' => [
            'label' => 'Position',
            'config' => ['type' => 'number'],
        ],
        'required' => [
            'label' => 'Required',
            'config' => ['type' => 'check'],
        ],
        'hidden' => [
            'label' => 'Hidden',
            'config' => ['type' => 'check'],
        ],
        'image' => [
            'label' => 'Image',
            'config' => [
                'type' => 'file',
                'maxitems' => 1,
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
        'answers' => [
            'label' => 'Answers',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_equedlms_domain_model_quizanswer',
                'foreign_field' => 'quiz_question',
                'maxitems' => 9999,
            ],
        ],
    ],
];