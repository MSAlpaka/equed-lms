
<?php
defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(function () {
    ExtensionManagementUtility::addTCAcolumns('tx_equedlms_domain_model_courseprogram', [
        'title' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseprogram.title',
            'config' => [
                'type' => 'input',
                'required' => true,
            ],
        ],
        'identifier' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseprogram.identifier',
            'config' => [
                'type' => 'input',
                'required' => true,
                'eval' => 'unique'
            ],
        ],
        'description' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseprogram.description',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'richtextConfiguration' => 'default',
                'cols' => 40,
                'rows' => 10,
            ],
        ],
        'certification_goal' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseprogram.certification_goal',
            'config' => [
                'type' => 'input',
            ],
        ],
        'prerequisites' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseprogram.prerequisites',
            'config' => [
                'type' => 'text',
                'rows' => 5,
                'cols' => 40,
                'eval' => 'trim'
            ],
        ],
        'is_specialty' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseprogram.is_specialty',
            'config' => [
                'type' => 'check',
                'items' => [
                    ['LLL:EXT:core/Resources/Private/Language/locallang_core.xlf:labels.enabled', 1]
                ]
            ],
        ],
        'requires_validation' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseprogram.requires_validation',
            'config' => [
                'type' => 'check',
                'items' => [
                    ['LLL:EXT:core/Resources/Private/Language/locallang_core.xlf:labels.enabled', 1]
                ]
            ],
        ],
    ]);

    ExtensionManagementUtility::addToAllTCAtypes(
        'tx_equedlms_domain_model_courseprogram',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
         title, identifier, description, certification_goal, prerequisites, is_specialty, requires_validation'
    );
})();
