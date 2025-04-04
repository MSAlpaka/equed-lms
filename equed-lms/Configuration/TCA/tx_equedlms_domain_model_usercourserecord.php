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
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => ['type' => 'language'],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'foreign_table' => 'tx_equedlms_domain_model_usercourserecord',
                'foreign_table_where' => 'AND {#tx_equedlms_domain_model_usercourserecord}.{#pid}=###CURRENT_PID### AND {#tx_equedlms_domain_model_usercourserecord}.{#sys_language_uid} IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => ['type' => 'passthrough'],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => ['type' => 'checkbox'],
        ],
        'fe_user' => [
            'exclude' => true,
            'label' => 'Teilnehmende*r',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'size' => 1,
                'minitems' => 1,
                'maxitems' => 1,
            ],
        ],
        'course' => [
            'exclude' => true,
            'label' => 'Kurs',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_equedlms_domain_model_course',
                'minitems' => 1,
                'maxitems' => 1,
            ],
        ],
        'completed' => [
            'exclude' => true,
            'label' => 'Abgeschlossen durch Instructor',
            'config' => ['type' => 'check'],
        ],
        'validated' => [
            'exclude' => true,
            'label' => 'Zentral validiert',
            'config' => ['type' => 'check'],
        ],
        'certificate_code' => [
            'exclude' => true,
            'label' => 'Zertifikatscode',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'eval' => 'trim'
            ],
        ],
        'completion_date' => [
            'exclude' => true,
            'label' => 'Abschlussdatum',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'datetime'
            ],
        ],
        'participant_postal_code' => [
            'exclude' => true,
            'label' => 'PLZ Teilnehmende*r',
            'config' => [
                'type' => 'input',
                'eval' => 'trim'
            ],
        ],
        'matching_status' => [
            'exclude' => true,
            'label' => 'Zuweisungsstatus',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['Nicht zugewiesen', 0],
                    ['Automatisch zugewiesen', 1],
                    ['Manuell zugewiesen', 2],
                ],
                'default' => 0,
            ],
        ],
        'instructor' => [
            'exclude' => true,
            'label' => 'Instructor',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'center' => [
            'exclude' => true,
            'label' => 'Zugewiesenes Ausbildungszentrum',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_equedlms_domain_model_center',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
    ],
];