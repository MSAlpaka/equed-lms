
<?php
defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(function () {
    ExtensionManagementUtility::addTCAcolumns('tx_equedlms_domain_model_coursematerial', [
        'title' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.title',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,required',
            ],
        ],
        'description' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.description',
            'config' => [
                'type' => 'text',
                'rows' => 3,
                'cols' => 60,
            ],
        ],
        'material_type' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:coursematerial.material_type',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['PDF', 'pdf'],
                    ['Video', 'video'],
                    ['Audio', 'audio'],
                    ['Image', 'image'],
                    ['Link', 'link'],
                    ['Worksheet', 'worksheet'],
                    ['Presentation', 'presentation'],
                    ['Archive', 'archive'],
                    ['Other', 'other'],
                ],
                'default' => 'pdf',
            ],
        ],
        'file' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.file',
            'config' => [
                'type' => 'file',
                'maxitems' => 1,
            ],
        ],
        'external_url' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.url',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ],
        ],
        'related_program' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:coursematerial.related_program',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_courseprogram',
                'maxitems' => 1,
            ],
        ],
        'related_instance' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:coursematerial.related_instance',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_courseinstance',
                'maxitems' => 1,
            ],
        ],
        'related_lesson' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:coursematerial.related_lesson',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_lesson',
                'maxitems' => 1,
            ],
        ],
        'related_page' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:coursematerial.related_page',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_contentpage',
                'maxitems' => 1,
            ],
        ],
        'is_optional' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:coursematerial.is_optional',
            'config' => [
                'type' => 'check',
                'default' => 1,
            ],
        ],
        'is_visible' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_common.xlf:label.visible',
            'config' => [
                'type' => 'check',
                'default' => 1,
            ],
        ],
        'downloadable' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:coursematerial.downloadable',
            'config' => [
                'type' => 'check',
                'default' => 1,
            ],
        ],
        'language' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
                'default' => 'en',
            ],
        ],
        'uuid' => [
            'label' => 'UUID',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,unique,required',
            ],
        ],
        'created_at' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.creationDate',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'valid_until' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'datetime',
            ],
        ],
    ]);

    ExtensionManagementUtility::addToAllTCAtypes(
        'tx_equedlms_domain_model_coursematerial',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        title, description, material_type, file, external_url, related_program,
        related_instance, related_lesson, related_page, is_optional, is_visible,
        downloadable, language, uuid, created_at, valid_until'
    );
})();
