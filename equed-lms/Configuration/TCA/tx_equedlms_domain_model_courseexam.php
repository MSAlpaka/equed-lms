<?php
defined('TYPO3') or die();

// TCA für CourseExam
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'tx_equedlms_domain_model_courseexam',
    [
        'exam_type' => [
            'exclude' => 0,
            'label' => 'Exam Type',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['Theory', 'Theory'],
                    ['Practical', 'Practical'],
                    ['Case Study', 'Case Study'],
                ],
            ],
        ],
        'passing_grade' => [
            'exclude' => 0,
            'label' => 'Passing Grade (%)',
            'config' => [
                'type' => 'input',
                'eval' => 'int',
                'default' => 70, // Standard 70% als Bestehensnote
            ],
        ],
        'status' => [
            'exclude' => 0,
            'label' => 'Status',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['Passed', 'Passed'],
                    ['Failed', 'Failed'],
                ],
                'default' => 'Failed',
            ],
        ],
        'exam_date' => [
            'exclude' => 0,
            'label' => 'Exam Date',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime',
                'default' => '0',
            ],
        ],
    ]
);

// TCA für das Backend anzeigen
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tx_equedlms_domain_model_courseexam',
    'exam_type,passing_grade,status,exam_date',
    '',
    'after:exam_date'
);