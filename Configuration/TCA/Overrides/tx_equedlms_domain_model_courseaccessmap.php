
<?php
defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(function () {
    ExtensionManagementUtility::addTCAcolumns('tx_equedlms_domain_model_courseaccessmap', [
        'course_program' => [
            'label' => 'Target Course Program',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_equedlms_domain_model_courseprogram',
                'renderType' => 'selectSingle',
            ],
        ],
        'required_certificate' => [
            'label' => 'Required Certificate (optional)',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_equedlms_domain_model_coursecertificate',
                'renderType' => 'selectSingle',
                'default' => 0,
            ],
        ],
        'required_goals_json' => [
            'label' => 'Required Learning Goals (JSON)',
            'config' => [
                'type' => 'text',
                'rows' => 6,
                'eval' => 'trim',
            ],
        ],
        'requires_approval' => [
            'label' => 'Requires Manual Approval',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'allowed_roles_json' => [
            'label' => 'Allowed User Roles (JSON)',
            'config' => [
                'type' => 'text',
                'rows' => 4,
                'eval' => 'trim',
            ],
        ],
        'is_public' => [
            'label' => 'Visible in Course List',
            'config' => [
                'type' => 'check',
                'default' => 1,
            ],
        ],
        'is_active' => [
            'label' => 'Active Rule',
            'config' => [
                'type' => 'check',
                'default' => 1,
            ],
        ],
        'note' => [
            'label' => 'Admin Note',
            'config' => [
                'type' => 'text',
                'rows' => 3,
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
        'tx_equedlms_domain_model_courseaccessmap',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        course_program, required_certificate, required_goals_json, allowed_roles_json,
        requires_approval, is_public, is_active, note, uuid, created_at, updated_at'
    );
})();
