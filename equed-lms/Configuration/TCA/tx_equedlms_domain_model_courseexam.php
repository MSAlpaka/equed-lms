<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_courseexam',
        'label' => 'exam_type',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_courseexam.svg',
    ],
    'types' => [
        '0' => [
            'showitem' => '
                --div--;General,
                    exam_type, passing_grade, status,
                --div--;Relations,
                    course
            ',
        ],
    ],
    'columns' => [
        'exam_type' => [
            'label' => 'Exam Type',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['Theory', 'theory'],
                    ['Practical', 'practical'],
                    ['Case Study', 'case_study'],
                ],
                'default' => 'theory',
            ],
        ],
        'passing_grade' => [
            'label' => 'Passing Grade (%)',
            'config' => [
                'type' => 'number',
                'default' => 70,
            ],
        ],
        'status' => [
            'label' => 'Status',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['Draft', 'draft'],
                    ['Active', 'active'],
                    ['Archived', 'archived'],
                ],
                'default' => 'active',
            ],
        ],
        'course' => [
            'label' => 'Course',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_equedlms_domain_model_course',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
    ],
];