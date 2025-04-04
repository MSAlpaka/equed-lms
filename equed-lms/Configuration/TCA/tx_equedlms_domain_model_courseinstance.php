<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_courseinstance',
        'label' => 'program',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'searchFields' => 'program,center',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/courseinstance.svg',
    ],
    'types' => [
        '1' => ['showitem' =>
            'program, center, start_date, end_date, is_public, auto_assign_instructor, max_participants,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:relations,
            instructors, user_course_records'
        ],
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
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'foreign_table' => 'tx_equedlms_domain_model_courseinstance',
                'foreign_table_where' => 'AND tx_equedlms_domain_model_courseinstance.pid=###CURRENT_PID### AND tx_equedlms_domain_model_courseinstance.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],

        'program' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_courseinstance.program',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_equedlms_domain_model_courseprogram',
                'minitems' => 1,
            ],
        ],

        'center' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_courseinstance.center',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_center',
                'size' => 1,
                'minitems' => 1,
                'maxitems' => 1,
            ],
        ],

        'start_date' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_courseinstance.start_date',
            'config' => [
                'type' => 'datetime',
                'required' => true,
            ],
        ],

        'end_date' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_courseinstance.end_date',
            'config' => [
                'type' => 'datetime',
                'required' => false,
            ],
        ],

        'is_public' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_courseinstance.is_public',
            'config' => [
                'type' => 'check',
                'default' => 1,
            ],
        ],

        'auto_assign_instructor' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_courseinstance.auto_assign_instructor',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],

        'max_participants' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_courseinstance.max_participants',
            'config' => [
                'type' => 'number',
                'default' => 0,
            ],
        ],

        'instructors' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_courseinstance.instructors',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'foreign_table_where' => 'AND fe_users.usergroup IN (SELECT uid FROM fe_groups WHERE title LIKE "%Instructor%")',
                'size' => 5,
                'maxitems' => 20,
            ],
        ],

        'user_course_records' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_courseinstance.user_course_records',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_equedlms_domain_model_usercourserecord',
                'foreign_field' => 'course_instance',
                'appearance' => [
                    'collapseAll' => true,
                    'newRecordLinkAddTitle' => true,
                    'newRecordLinkPosition' => 'bottom',
                    'useSortable' => true,
                ],
            ],
        ],
    ],
];