<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_usersubmission.title',
        'label' => 'type',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/usersubmission.svg'
    ],
    'columns' => [
        'type' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_usersubmission.type',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['Case Study', 'caseStudy'],
                    ['Practice Exam', 'practiceExam'],
                    ['Theory Exam', 'theoryExam'],
                    ['Other', 'other'],
                ],
                'required' => true
            ]
        ],
        'comment' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_usersubmission.comment',
            'config' => [
                'type' => 'text',
                'rows' => 4
            ]
        ],
        'document' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_usersubmission.document',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('document', [
                'appearance' => [
                    'createNewRelationLinkTitle' => 'Add File'
                ],
                'maxitems' => 1
            ])
        ],
        'fe_user' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_usersubmission.fe_user',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'size' => 1,
                'maxitems' => 1,
            ]
        ],
        'course' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_usersubmission.course',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_course',
                'size' => 1,
                'maxitems' => 1,
            ]
        ],
        'submitted_at' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_usersubmission.submitted_at',
            'config' => [
                'type' => 'datetime'
            ]
        ]
    ],
    'types' => [
        '0' => [
            'showitem' => 'type, comment, document, fe_user, course, submitted_at'
        ]
    ]
];