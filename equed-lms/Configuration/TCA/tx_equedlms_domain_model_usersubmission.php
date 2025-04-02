<?php

return [
    'ctrl' => [
        'title' => 'User Submission',
        'label' => 'type',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'type,comment,status,grade',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/usersubmission.svg',
    ],
    'types' => [
        '0' => ['showitem' => 'fe_user, user_course_record, lesson, type, status, grade, comment'],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'language',
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l10n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_equedlms_domain_model_usersubmission',
                'foreign_table_where' => 'AND {#tx_equedlms_domain_model_usersubmission}.{#pid}=###CURRENT_PID### AND {#tx_equedlms_domain_model_usersubmission}.{#sys_language_uid} IN (-1,0)',
                'default' => 0,
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'hidden' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'checkbox',
            ],
        ],
        'fe_user' => [
            'exclude' => true,
            'label' => 'Frontend User',
            'config' => [
                'type' => 'input',
                'eval' => 'int',
            ],
        ],
        'user_course_record' => [
            'exclude' => true,
            'label' => 'User Course Record',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_usercourserecord',
                'maxitems' => 1,
                'minitems' => 1,
            ],
        ],
        'lesson' => [
            'exclude' => true,
            'label' => 'Lesson',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_lesson',
                'maxitems' => 1,
            ],
        ],
        'type' => [
            'exclude' => true,
            'label' => 'Type',
            'config' => [
                'type' => 'input',
                'required' => true,
            ],
        ],
        'status' => [
            'exclude' => true,
            'label' => 'Status',
            'config' => [
                'type' => 'input',
            ],
        ],
        'grade' => [
            'exclude' => true,
            'label' => 'Grade',
            'config' => [
                'type' => 'input',
            ],
        ],
        'comment' => [
            'exclude' => true,
            'label' => 'Comment',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
            ],
        ],
    ],
];