<?php

return [
    'ctrl' => [
        'title' => 'User Course Record',
        'label' => 'fe_user',
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
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/usercourserecord.svg',
    ],
    'types' => [
        '0' => ['showitem' => 'fe_user, course, completed, validated, certificate_code, completion_date, participant_postal_code, matching_status, instructor, center'],
    ],
    'columns' => [
        'sys_language_uid' => ['exclude' => true, 'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language', 'config' => ['type' => 'language']],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l10n_parent',
            'config' => [
                'type' => 'select', 'renderType' => 'selectSingle',
                'items' => [['', 0]],
                'foreign_table' => 'tx_equedlms_domain_model_usercourserecord',
                'foreign_table_where' => 'AND {#tx_equedlms_domain_model_usercourserecord}.{#pid}=###CURRENT_PID###',
                'default' => 0,
            ],
        ],
        'l10n_diffsource' => ['config' => ['type' => 'passthrough']],
        'hidden' => ['label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden', 'config' => ['type' => 'checkbox']],

        'fe_user' => ['label' => 'Frontend User', 'config' => ['type' => 'input', 'eval' => 'int']],
        'course' => [
            'label' => 'Course',
            'config' => [
                'type' => 'group', 'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_course',
                'maxitems' => 1,
            ],
        ],
        'completed' => ['label' => 'Completed', 'config' => ['type' => 'check']],
        'validated' => ['label' => 'Validated', 'config' => ['type' => 'check']],
        'certificate_code' => ['label' => 'Certificate Code', 'config' => ['type' => 'input']],
        'completion_date' => ['label' => 'Completion Date', 'config' => ['type' => 'input', 'renderType' => 'inputDateTime']],
        'participant_postal_code' => ['label' => 'Postal Code', 'config' => ['type' => 'input']],
        'matching_status' => ['label' => 'Matching Status', 'config' => ['type' => 'input']],
        'instructor' => [
            'label' => 'Instructor',
            'config' => [
                'type' => 'group', 'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_instructor',
                'maxitems' => 1,
            ],
        ],
        'center' => [
            'label' => 'Center',
            'config' => [
                'type' => 'group', 'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_center',
                'maxitems' => 1,
            ],
        ],
    ],
];