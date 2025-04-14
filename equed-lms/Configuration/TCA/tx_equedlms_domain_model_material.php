<?php

return [
    'ctrl' => [
        'title' => 'Material',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'versioningWS' => true,
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'title,description,file',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_material.svg',
    ],
    'types' => [
        '1' => ['showitem' => 'title, description, file, lesson'],
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
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_equedlms_domain_model_material',
                'foreign_table_where' => 'AND {#tx_equedlms_domain_model_material}.{#pid}=###CURRENT_PID### AND {#tx_equedlms_domain_model_material}.{#sys_language_uid} IN (-1,0)',
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
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'title' => [
            'label' => 'Title',
            'config' => [
                'type' => 'input',
                'required' => true,
            ],
        ],
        'description' => [
            'label' => 'Description',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
            ],
        ],
        'file' => [
            'label' => 'File',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputLink',
                'allowed' => 'file',
                'size' => 30,
                'eval' => 'trim',
                'fieldControl' => [
                    'linkPopup' => [
                        'options' => [
                            'blindLinkOptions' => 'page,url,mail,telephone',
                        ],
                    ],
                ],
            ],
        ],
        'lesson' => [
            'label' => 'Related Lesson',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_equedlms_domain_model_lesson',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
    ],
];
