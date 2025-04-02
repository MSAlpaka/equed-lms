<?php

return [
    'ctrl' => [
        'title' => 'Quiz Answer',
        'label' => 'text',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/quizanswer.svg',
    ],
    'columns' => [
        'text' => [
            'label' => 'Answer Text',
            'config' => [
                'type' => 'input',
                'required' => true,
            ],
        ],
        'is_correct' => [
            'label' => 'Correct?',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'question' => [
            'label' => 'Question',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_equedlms_domain_model_quizquestion',
                'minitems' => 1,
                'maxitems' => 1,
            ],
        ],
    ],
    'types' => [
        '0' => ['showitem' => 'question, text, is_correct'],
    ],
];