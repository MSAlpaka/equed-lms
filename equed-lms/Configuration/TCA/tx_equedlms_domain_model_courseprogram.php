<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_courseprogram',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'searchFields' => 'title,slug,description,requirements,goals',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/courseprogram.svg',
    ],
    'types' => [
        '1' => ['showitem' =>
            'title, slug, description, duration, certification, requirements, goals,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:relations,
            instances'
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
                'foreign_table' => 'tx_equedlms_domain_model_courseprogram',
                'foreign_table_where' => 'AND tx_equedlms_domain_model_courseprogram.pid=###CURRENT_PID### AND tx_equedlms_domain_model_courseprogram.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],

        'title' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_courseprogram.title',
            'config' => [
                'type' => 'input',
                'required' => true,
                'size' => 50,
            ],
        ],

        'slug' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_courseprogram.slug',
            'config' => [
                'type' => 'slug',
                'generatorOptions' => [
                    'fields' => ['title'],
                ],
                'fallbackCharacter' => '-',
                'prefixParentPageSlug' => true,
            ],
        ],

        'description' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_courseprogram.description',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'richtextConfiguration' => 'default',
                'rows' => 5,
            ],
        ],

        'duration' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_courseprogram.duration',
            'config' => [
                'type' => 'number',
                'required' => true,
                'default' => 0,
            ],
        ],

        'certification' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_courseprogram.certification',
            'config' => [
                'type' => 'input',
                'size' => 40,
            ],
        ],

        'requirements' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_courseprogram.requirements',
            'config' => [
                'type' => 'text',
                'rows' => 4,
            ],
        ],

        'goals' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_courseprogram.goals',
            'config' => [
                'type' => 'text',
                'rows' => 4,
            ],
        ],

        'instances' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_courseprogram.instances',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_equedlms_domain_model_courseinstance',
                'foreign_field' => 'program',
                'appearance' => [
                    'collapseAll' => true,
                    'newRecordLinkPosition' => 'bottom',
                    'useSortable' => true,
                ],
            ],
        ],
    ],
];