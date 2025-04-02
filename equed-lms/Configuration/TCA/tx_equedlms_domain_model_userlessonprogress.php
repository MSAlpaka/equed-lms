<?php

return [
    'ctrl' => [
        'title' => 'User Lesson Progress',
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
        'searchFields' => 'fe_user',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/userlessonprogress.svg',
    ],
    'types' => [
        '0' => ['showitem' => 'fe_user, lesson, quiz_score, completed, confirmed'],
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
                'foreign_table' => 'tx_equedlms_domain_model_userlessonprogress',
                'foreign_table_where' => 'AND {#tx_equedlms_domain_model_userlessonprogress}.{#pid}=###CURRENT_PID### AND {#tx_equedlms_domain_model_userlessonprogress}.{#sys_language_uid} IN (-1,0)',
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
        'lesson' => [
            'exclude' => true,
            'label' => 'Lesson',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_lesson',
                'maxitems' => 1,
                'minitems' => 1,
            ],
        ],
        'quiz_score' => [
            'exclude' => true,
            'label' => 'Quiz Score',
            'config' => [
                'type' => 'number',
            ],
        ],
        'completed' => [
            'exclude' => true,
            'label' => 'Completed',
            'config' => [
                'type' => 'check',
            ],
        ],
        'confirmed' => [
            'exclude' => true,
            'label' => 'Confirmed',
            'config' => [
                'type' => 'check',
            ],
        ],
    ],
];