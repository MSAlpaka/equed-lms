
<?php
defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(function () {
    ExtensionManagementUtility::addTCAcolumns('tx_equedlms_domain_model_accesspolicy', [
        'title' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.title',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,required',
            ],
        ],
        'policy_type' => [
            'label' => 'Policy Type',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['Course Access', 'course_access'],
                    ['Lesson Unlock', 'lesson_unlock'],
                    ['Upload Required', 'upload_required'],
                    ['Role Based', 'role_based'],
                    ['Timed Access', 'timed'],
                    ['Custom Condition', 'custom_condition'],
                ],
                'default' => 'course_access',
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
            'label' => 'Target Identifier (UID, slug, key)',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ],
        ],
        'required_user_role' => [
            'label' => 'Required User Role',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['Participant', 'participant'],
                    ['Instructor', 'instructor'],
                    ['Certifier', 'certifier'],
                    ['Admin', 'admin'],
                    ['ServiceCenter', 'servicecenter'],
                ],
            ],
        ],
        'required_certificates' => [
            'label' => 'Required Certificates',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_equedlms_domain_model_coursecertificate',
                'maxitems' => 99,
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                ],
            ],
        ],
        'required_progress' => [
            'label' => 'Required Progress (%)',
            'config' => [
                'type' => 'number',
                'range' => ['lower' => 0, 'upper' => 100],
            ],
        ],
        'required_uploads' => [
            'label' => 'Upload(s) Required',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'available_from' => [
            'label' => 'Available From',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'available_until' => [
            'label' => 'Available Until',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'custom_condition' => [
            'label' => 'Custom Condition (JSON)',
            'config' => [
                'type' => 'text',
                'enableRichtext' => false,
                'rows' => 4,
            ],
        ],
        'error_message' => [
            'label' => 'Error Message',
            'config' => [
                'type' => 'text',
                'rows' => 2,
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
        'is_active' => [
            'label' => 'Active',
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
        'created_at' => [
            'label' => 'Created At',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'updated_at' => [
            'label' => 'Updated At',
            'config' => [
                'type' => 'datetime',
            ],
        ],
    ]);

    ExtensionManagementUtility::addToAllTCAtypes(
        'tx_equedlms_domain_model_accesspolicy',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        title, policy_type, target_model, target_identifier, required_user_role,
        required_certificates, required_progress, required_uploads,
        available_from, available_until, custom_condition,
        error_message, is_active, language, uuid, created_at, updated_at'
    );
})();
