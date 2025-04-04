<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_usercourserecord',
        'label' => 'user',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'delete' => 'deleted',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'versioningWS' => true,
        'searchFields' => 'user,note,exam_results,instructor_feedback',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/usercourserecord.svg',
    ],
    'types' => [
        '1' => ['showitem' =>
            'user, course_instance, status, progress, enrollment_date, last_activity_date,
            certificate_issued, completion_date, exam_results, practical_assessment, instructor_feedback, note, 
            is_retake, attempt_number, 
            marked_as_completed_by, marked_as_completed_at, validated_by, validated_at'
        ],
    ],
    'columns' => [

        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => ['type' => 'language'],
        ],

        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_equedlms_domain_model_usercourserecord',
                'foreign_table_where' => 'AND tx_equedlms_domain_model_usercourserecord.pid=###CURRENT_PID### AND tx_equedlms_domain_model_usercourserecord.sys_language_uid IN (-1,0)',
                'default' => 0,
            ],
        ],

        'l10n_diffsource' => ['config' => ['type' => 'passthrough']],

        'user' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_usercourserecord.user',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'minitems' => 1,
                'maxitems' => 1,
            ],
        ],

        'course_instance' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_usercourserecord.course_instance',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_equedlms_domain_model_courseinstance',
                'minitems' => 1,
                'maxitems' => 1,
            ],
        ],

        'status' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_usercourserecord.status',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['ongoing', 'ongoing'],
                    ['completed', 'completed'],
                    ['failed', 'failed'],
                    ['withdrawn', 'withdrawn'],
                ],
                'default' => 'ongoing',
            ],
        ],

        'progress' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_usercourserecord.progress',
            'config' => [
                'type' => 'number',
                'default' => 0.0,
            ],
        ],

        'certificate_issued' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_usercourserecord.certificate_issued',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],

        'completion_date' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_usercourserecord.completion_date',
            'config' => [
                'type' => 'datetime',
            ],
        ],

        'enrollment_date' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_usercourserecord.enrollment_date',
            'config' => [
                'type' => 'datetime',
            ],
        ],

        'last_activity_date' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_usercourserecord.last_activity_date',
            'config' => [
                'type' => 'datetime',
            ],
        ],

        'exam_results' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_usercourserecord.exam_results',
            'config' => [
                'type' => 'text',
                'rows' => 4,
            ],
        ],

        'practical_assessment' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_usercourserecord.practical_assessment',
            'config' => [
                'type' => 'text',
                'rows' => 4,
            ],
        ],

        'instructor_feedback' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_usercourserecord.instructor_feedback',
            'config' => [
                'type' => 'text',
                'rows' => 4,
            ],
        ],

        'note' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_usercourserecord.note',
            'config' => [
                'type' => 'text',
                'rows' => 2,
            ],
        ],

        'is_retake' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_usercourserecord.is_retake',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],

        'attempt_number' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_usercourserecord.attempt_number',
            'config' => [
                'type' => 'number',
                'default' => 1,
            ],
        ],

        'marked_as_completed_by' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_usercourserecord.marked_as_completed_by',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'maxitems' => 1,
            ],
        ],

        'marked_as_completed_at' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_usercourserecord.marked_as_completed_at',
            'config' => [
                'type' => 'datetime',
            ],
        ],

        'validated_by' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_usercourserecord.validated_by',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'maxitems' => 1,
            ],
        ],

        'validated_at' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_usercourserecord.validated_at',
            'config' => [
                'type' => 'datetime',
            ],
        ],
    ],
];