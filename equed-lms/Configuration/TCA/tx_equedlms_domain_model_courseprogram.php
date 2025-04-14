<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_courseprogram',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'searchFields' => 'title,slug,description,requirements,goals',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/courseprogram.svg',
    ],
    'types' => [
        '1' => [
            'showitem' => '
                --div--;General,
                    title, slug, description, duration, certification,
                --div--;Logic,
                    requirements, goals,
                --div--;Relations,
                    instances
            ',
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
            ],
        ],
        'slug' => [
            'label' => 'Slug',
            'config' => [
                'type' => 'slug',
                'generatorOptions' => [
                    'fields' => ['title'],
                ],
                'fallbackCharacter' => '-',
                'eval' => 'unique',
            ],
        ],
        'description' => [
            'label' => 'Description',
            'config' => [
                'type' => 'text',
                'rows' => 5,
            ],
        ],
        'duration' => [
            'label' => 'Duration (in hours)',
            'config' => [
                'type' => 'number',
                'default' => 0,
            ],
        ],
        'certification' => [
            'label' => 'Certification',
            'config' => [
                'type' => 'input',
            ],
        ],
        'requirements' => [
            'label' => 'Requirements',
            'config' => [
                'type' => 'text',
                'rows' => 4,
            ],
        ],
        'goals' => [
            'label' => 'Goals',
            'config' => [
                'type' => 'text',
                'rows' => 4,
            ],
        ],
        'instances' => [
            'label' => 'Instances',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_equedlms_domain_model_courseinstance',
                'foreign_field' => 'program',
                'appearance' => [
                    'collapseAll' => true,
                    'useSortable' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
    ],
];