<?php

return [
    'ctrl' => [
        'title' => 'Exam Attempt',
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
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/examattempt.svg',
    ],
    'types' => [
        '0' => ['showitem' => 'type, passed, feedback, user_course_record, lesson, examiner'],
    ],
    'columns' => [
        'sys_language_uid' => ['exclude' => true, 'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language', 'config' => ['type' => 'language']],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l10n_parent',
            'config' => [
                'type' => 'select', 'renderType' => 'selectSingle',
                'items' => [['', 0]],
                'foreign_table' => 'tx_equedlms_domain_model_examattempt',
                'foreign_table_where' => 'AND {#tx_equedlms_domain_model_examattempt}.{#pid}=###CURRENT_PID###',
                'default' => 0,
            ],
        ],
        'l10n_diffsource' => ['config' => ['type' => 'passthrough']],
        'hidden' => ['label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden', 'config' => ['type' => 'checkbox']],

        'type' => ['label' => 'Type', 'config' => ['type' => 'input', 'required' => true]],
        'passed' => ['label' => 'Passed', 'config' => ['type' => 'check']],
        'feedback' => ['label' => 'Feedback', 'config' => ['type' => 'text', 'enableRichtext' => true]],
        'user_course_record' => [
            'label' => 'User Course Record',
            'config' => [
                'type' => 'group', 'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_usercourserecord',
                'maxitems' => 1,
            ],
        ],
        'lesson' => [
            'label' => 'Lesson',
            'config' => [
                'type' => 'group', 'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_lesson',
                'maxitems' => 1,
            ],
        ],
        'examiner' => [
            'label' => 'Examiner',
            'config' => [
                'type' => 'group', 'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_instructor',
                'maxitems' => 1,
            ],
        ],
    ],
];