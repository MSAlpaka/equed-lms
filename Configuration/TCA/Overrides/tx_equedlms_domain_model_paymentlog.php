
<?php
defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(function () {
    ExtensionManagementUtility::addTCAcolumns('tx_equedlms_domain_model_paymentlog', [
        'fe_user' => [
            'label' => 'User',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'size' => 1,
                'maxitems' => 1,
            ],
        ],
        'amount' => [
            'label' => 'Amount',
            'config' => [
                'type' => 'number',
                'eval' => 'double2',
            ],
        ],
        'currency' => [
            'label' => 'Currency',
            'config' => [
                'type' => 'input',
                'size' => 5,
                'default' => 'EUR',
            ],
        ],
        'payment_method' => [
            'label' => 'Payment Method',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['Stripe', 'stripe'],
                    ['PayPal', 'paypal'],
                    ['Manual Bank Transfer', 'manual'],
                    ['Voucher / Coupon', 'voucher'],
                    ['Other', 'other'],
                ],
                'default' => 'stripe',
            ],
        ],
        'status' => [
            'label' => 'Status',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['Pending', 'pending'],
                    ['Paid', 'paid'],
                    ['Failed', 'failed'],
                    ['Refunded', 'refunded'],
                ],
                'default' => 'pending',
            ],
        ],
        'reference' => [
            'label' => 'Reference ID (External)',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ],
        ],
        'context' => [
            'label' => 'Context (Course, Material, Membership)',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ],
        ],
        'context_id' => [
            'label' => 'Related Object ID (internal)',
            'config' => [
                'type' => 'input',
                'eval' => 'int',
            ],
        ],
        'timestamp' => [
            'label' => 'Timestamp of Payment',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'is_manual' => [
            'label' => 'Manual Confirmation?',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'is_refunded' => [
            'label' => 'Refunded?',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'note' => [
            'label' => 'Note',
            'config' => [
                'type' => 'text',
                'rows' => 3,
            ],
        ],
        'raw_response' => [
            'label' => 'Raw Gateway Response',
            'config' => [
                'type' => 'text',
                'rows' => 6,
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
        'tx_equedlms_domain_model_paymentlog',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        fe_user, amount, currency, payment_method, status, reference,
        context, context_id, timestamp, is_manual, is_refunded, note,
        raw_response, uuid, created_at, updated_at'
    );
})();
