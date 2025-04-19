
<?php
defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(function () {
    ExtensionManagementUtility::addTCAcolumns('tx_equedlms_domain_model_certificatedispatch', [
        'user' => [
            'label' => 'User',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'maxitems' => 1,
            ],
        ],
        'course_certificate' => [
            'label' => 'Course Certificate',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_equedlms_domain_model_coursecertificate',
                'renderType' => 'selectSingle',
            ],
        ],
        'shipping_address' => [
            'label' => 'Shipping Address',
            'config' => [
                'type' => 'text',
                'rows' => 4,
            ],
        ],
        'dispatch_type' => [
            'label' => 'Dispatch Type',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['Postal Card', 'postal_card'],
                    ['Paper Certificate', 'paper_certificate'],
                    ['Starter Kit', 'starter_kit'],
                    ['Custom', 'custom'],
                ],
                'default' => 'postal_card',
            ],
        ],
        'dispatched_by' => [
            'label' => 'Dispatched By',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ],
        ],
        'dispatched_at' => [
            'label' => 'Dispatched At',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'tracking_code' => [
            'label' => 'Tracking Code',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ],
        ],
        'courier_service' => [
            'label' => 'Courier Service',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ],
        ],
        'status' => [
            'label' => 'Dispatch Status',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['Pending', 'pending'],
                    ['Dispatched', 'dispatched'],
                    ['Failed', 'failed'],
                    ['Returned', 'returned'],
                ],
                'default' => 'pending',
            ],
        ],
        'notes' => [
            'label' => 'Internal Notes',
            'config' => [
                'type' => 'text',
                'rows' => 3,
            ],
        ],
        'language' => [
            'label' => 'Certificate Language',
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
        'tx_equedlms_domain_model_certificatedispatch',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        user, course_certificate, shipping_address, dispatch_type,
        dispatched_by, dispatched_at, tracking_code, courier_service,
        status, notes, language, uuid, created_at, updated_at'
    );
})();
