<?php

return [
    'ctrl' => [
        'title' => 'Quiz Answer',
        'label' => 'answer_text',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'sortby' => 'position',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_quizanswer.svg',
    ],
    'types' => [
        '0' => [
            'showitem' => '
                --div--;Answer,
                    question, answer_text, feedback_text, is_correct, position, image
            ',
        ],
    ],
    'columns' => [
        'question' => [
            'label' => 'Question',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_equedlms_domain_model_quizquestion',
                'renderType' => 'selectSingle',
                'minitems' => 1,
                'maxitems' => 1,
            ],
        ],
        'answer_text' => [
            'label' => 'Answer Text',
            'config' => ['type' => 'text', 'rows' => 3],
        ],
        'feedback_text' => [
            'label' => 'Feedback Text',
            'config' => ['type' => 'text', 'rows' => 3],
        ],
        'is_correct' => [
            'label' => 'Correct?',
            'config' => ['type' => 'check'],
        ],
        'position' => [
            'label' => 'Position',
            'config' => ['type' => 'number'],
        ],
        'image' => [
            'label' => 'Image',
            'config' => [
                'type' => 'file',
                'maxitems' => 1,
            ],
        ],
    ],
];