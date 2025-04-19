
<?php
defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(function () {
    ExtensionManagementUtility::addTCAcolumns('tx_equedlms_domain_model_apitoken', [
        'title' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.title',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,required',
            ],
        ],
        'token' => [
            'label' => 'Token',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,required,unique',
                'readOnly' => true,
            ],
        ],
        'secret_hash' => [
            'label' => 'Hashed Secret',
            'config' => [
                'type' => 'none',
            ],
        ],
        'scope' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:apitoken.scope',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['General API', 'general'],
                    ['Lesson API', 'lesson'],
                    ['Instructor API', 'instructor'],
                    ['QMS API', 'qms'],
                    ['Admin API', 'admin'],
                ],
                'default' => 'general',
                'renderType' => 'selectSingle',
            ],
        ],
        'active' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_common.xlf:enabled',
            'config' => [
                'type' => 'check',
                'default' => 1,
            ],
        ],
        'usage_limit' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:apitoken.usage_limit',
            'config' => [
                'type' => 'number',
                'default' => 0,
            ],
        ],
        'usage_count' => [
            'label' => 'Usage Count',
            'config' => [
                'type' => 'number',
                'readOnly' => true,
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
        'fe_user' => [
            'label' => 'FE User',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'maxitems' => 1,
            ],
        ],
        'ip_restriction' => [
            'label' => 'IP Restriction (CIDR)',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ],
        ],
        'last_used' => [
            'label' => 'Last Used',
            'config' => [
                'type' => 'datetime',
                'readOnly' => true,
            ],
        ],
        'uuid' => [
            'label' => 'UUID',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,unique,required',
            ],
        ],
        'language' => [
            'label' => 'Language',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
                'default' => 'en',
            ],
        ],
        'created_at' => [
            'label' => 'Created At',
            'config' => [
                'type' => 'datetime',
            ],
        ],
    ]);

    ExtensionManagementUtility::addToAllTCAtypes(
        'tx_equedlms_domain_model_apitoken',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        title, token, secret_hash, scope, active, fe_user, usage_limit,
        usage_count, valid_from, valid_until, last_used, ip_restriction,
        language, uuid, created_at'
    );
})();
