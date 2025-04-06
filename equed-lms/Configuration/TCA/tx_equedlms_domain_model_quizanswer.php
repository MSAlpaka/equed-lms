<?php

return [
    'ctrl' => [
        'title' => 'Quiz Answer',
        'label' => 'answerText',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'hideTable' => false,
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_quizanswer.svg',
    ],
    'types' => [
        '0' => ['showitem' => '
            --div--;General,
                answerText, isCorrect, feedbackText, position, image, question
        '],
    ],
    'columns' => [
        'answerText' => [
            'label' => 'Answer Text',
            'config' => [
                'type' => 'input',
                'required' => true,
            ],
        ],
        'isCorrect' => [
            'label' => 'Is Correct',
            'config' => [
                'type' => 'check',
            ],
        ],
        'feedbackText' => [
            'label' => 'Feedback Text',
            'config' => [
                'type' => 'text',
                'rows' => 3,
            ],
        ],
        'position' => [
            'label' => 'Position',
            'config' => [
                'type' => 'input',
                'eval' => 'int',
            ],
        ],
        'image' => [
            'label' => 'Image',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'sys_file',
                'foreign_field' => 'uid',
                'maxitems' => 1,
                'appearance' => [
                    'useSortable' => true,
                    'showPossible' => true,
                    'showAll' => true,
                ],
            ],
        ],
        'question' => [
            'label' => 'Quiz Question',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_quizquestion',
                'size' => 1,
                'maxitems' => 1,
            ],
        ],
    ],
];
