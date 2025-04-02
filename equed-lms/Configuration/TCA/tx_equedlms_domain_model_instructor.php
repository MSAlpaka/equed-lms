<?php

return [
    'ctrl' => [
        'title' => 'Instructor',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => ['disabled' => 'hidden'],
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/instructor.svg',
    ],
    'types' => [
        '0' => ['showitem' => 'fe_user, name, email, is_available, region_postal_codes, center'],
    ],
    'columns' => [
        'sys_language_uid' => ['exclude' => true, 'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language', 'config' => ['type' => 'language']],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l10n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [['', 0]],
                'foreign_table' => 'tx_equedlms_domain_model_instructor',
                'foreign_table_where' => 'AND {#tx_equedlms_domain_model_instructor}.{#pid}=###CURRENT_PID###',
                'default' => 0,
            ],
        ],
        'l10n_diffsource' => ['config' => ['type' => 'passthrough']],
        'hidden' => ['label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden', 'config' => ['type' => 'checkbox']],

        'fe_user' => ['label' => 'Frontend User', 'config' => ['type' => 'input', 'eval' => 'int']],
        'name' => ['label' => 'Name', 'config' => ['type' => 'input', 'required' => true]],
        'email' => ['label' => 'Email', 'config' => ['type' => 'input', 'eval' => 'email']],
        'is_available' => ['label' => 'Available', 'config' => ['type' => 'check']],
        'region_postal_codes' => ['label' => 'Region Postal Codes', 'config' => ['type' => 'text']],
        'center' => [
            'label' => 'Center',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_center',
                'maxitems' => 1,
            ],
        ],
    ],
];