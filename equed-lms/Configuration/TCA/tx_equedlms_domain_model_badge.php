<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_badge',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_badge.svg',
    ],
    'types' => [
        '0' => [
            'showitem' => '
                --div--;General,
                    name, description, assignment_type,
                --div--;Relations,
                    related_course, related_lesson, recipients
            ',
        ],
    ],
    'columns' => [
        'name' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_badge.name',
            'config' => [
                'type' => 'input',
                'required' => true,
            ],
        ],
        'description' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_badge.description',
            'config' => [
                'type' => 'text',
                'rows' => 3,
            ],
        ],
        'assignment_type' => [
            'label' => 'Assignment Type',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['Manual', 'manual'],
                    ['Automatic', 'automatic'],
                ],
                'default' => 'manual',
            ],
        ],
        'related_course' => [
            'label' => 'Related Course',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_equedlms_domain_model_course',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'related_lesson' => [
            'label' => 'Related Lesson',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_equedlms_domain_model_lesson',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'recipients' => [
            'label' => 'Recipients',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'fe_users',
                'MM' => 'tx_equedlms_badge_recipient_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 9999,
            ],
        ],
    ],
];