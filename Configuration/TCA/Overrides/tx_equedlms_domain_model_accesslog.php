
<?php
defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(function () {
    ExtensionManagementUtility::addTCAcolumns('tx_equedlms_domain_model_accesslog', [
        'user' => [
            'label' => 'User',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'maxitems' => 1,
            ],
        ],
        'user_role' => [
            'label' => 'User Role at Time of Action',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['Participant', 'participant'],
                    ['Instructor', 'instructor'],
                    ['Certifier', 'certifier'],
                    ['ServiceCenter', 'servicecenter'],
                    ['Admin', 'admin'],
                    ['System', 'system'],
                ],
            ],
        ],
        'action' => [
            'label' => 'Action Type',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,required',
            ],
        ],
        'target_model' => [
            'label' => 'Target Model',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ],
        ],
        'target_identifier' => [
            'label' => 'Target Identifier',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ],
        ],
        'request_data' => [
            'label' => 'Request Data (JSON)',
            'config' => [
                'type' => 'text',
                'rows' => 6,
            ],
        ],
        'ip_address' => [
            'label' => 'IP Address',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ],
        ],
        'user_agent' => [
            'label' => 'User Agent',
            'config' => [
                'type' => 'text',
                'rows' => 3,
            ],
        ],
        'is_system_event' => [
            'label' => 'System Event',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'origin' => [
            'label' => 'Origin',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['Frontend SPA', 'spa_frontend'],
                    ['Mobile App', 'mobile_app'],
                    ['API Backend', 'api_backend'],
                    ['Certifier Dashboard', 'certifier_dashboard'],
                    ['Instructor Dashboard', 'instructor_dashboard'],
                    ['Admin Panel', 'admin'],
                ],
            ],
        ],
        'language' => [
            'label' => 'Language',
            'config' => [
                'type' => 'input',
                'default' => 'en',
            ],
        ],
        'notes' => [
            'label' => 'Notes',
            'config' => [
                'type' => 'text',
                'rows' => 3,
            ],
        ],
        'uuid' => [
            'label' => 'UUID',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,required,unique',
            ],
        ],
        'created_at' => [
            'label' => 'Timestamp',
            'config' => [
                'type' => 'datetime',
                'required' => true,
            ],
        ],
    ]);

    ExtensionManagementUtility::addToAllTCAtypes(
        'tx_equedlms_domain_model_accesslog',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        user, user_role, action, target_model, target_identifier,
        request_data, ip_address, user_agent, is_system_event, origin,
        language, notes, uuid, created_at'
    );
})();
