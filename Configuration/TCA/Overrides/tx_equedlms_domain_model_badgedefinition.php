
<?php
defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(function () {
    ExtensionManagementUtility::addTCAcolumns('tx_equedlms_domain_model_badgedefinition', [
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
        'badge_type' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:badgedefinition.badge_type',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['Recognition Award', 'recognition'],
                    ['Completion Badge', 'completion'],
                    ['Custom Badge', 'custom'],
                    ['Legacy Badge', 'legacy'],
                ],
                'default' => 'custom',
            ],
        ],
        'ruleset_json' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:badgedefinition.ruleset_json',
            'config' => [
                'type' => 'text',
            ],
        ],
        'auto_assign' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:badgedefinition.auto_assign',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'visible_publicly' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:badgedefinition.visible_publicly',
            'config' => [
                'type' => 'check',
                'default' => 1,
            ],
        ],
        'image' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.image',
            'config' => [
                'type' => 'file',
                'maxitems' => 1,
            ],
        ],
        'badge_level' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:badgedefinition.badge_level',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['None', 'none'],
                    ['Bronze', 'bronze'],
                    ['Silver', 'silver'],
                    ['Gold', 'gold'],
                ],
                'default' => 'none',
            ],
        ],
        'is_active' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_common.xlf:label.enabled',
            'config' => [
                'type' => 'check',
                'default' => 1,
            ],
        ],
        'uuid' => [
            'label' => 'UUID',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,unique,required',
            ],
        ],
        'badge_code' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:badgedefinition.badge_code',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,unique',
            ],
        ],
        'valid_from' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
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
        'related_program' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:badgedefinition.related_program',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_courseprogram',
                'maxitems' => 1,
            ],
        ],
    ]);

    ExtensionManagementUtility::addToAllTCAtypes(
        'tx_equedlms_domain_model_badgedefinition',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        title, description, badge_type, badge_code, badge_level, image,
        ruleset_json, auto_assign, visible_publicly, is_active, uuid,
        valid_from, valid_until, related_program'
    );
})();
