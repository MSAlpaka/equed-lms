
<?php
defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(function () {
    ExtensionManagementUtility::addTCAcolumns('tx_equedlms_domain_model_coursebundle', [
        'title' => [
            'label' => 'Bundle Title',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,required',
            ],
        ],
        'description' => [
            'label' => 'Description',
            'config' => [
                'type' => 'text',
                'rows' => 5,
                'enableRichtext' => true,
            ],
        ],
        'course_programs' => [
            'label' => 'Included Course Programs',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_equedlms_domain_model_courseprogram',
                'MM' => 'tx_equedlms_coursebundle_courseprogram_mm',
                'size' => 8,
                'autoSizeMax' => 20,
                'multiple' => 1,
            ],
        ],
        'price' => [
            'label' => 'Bundle Price (€)',
            'config' => [
                'type' => 'number',
                'eval' => 'double2',
            ],
        ],
        'discount_percentage' => [
            'label' => 'Optional Discount (%)',
            'config' => [
                'type' => 'number',
                'default' => 0,
            ],
        ],
        'is_active' => [
            'label' => 'Active',
            'config' => [
                'type' => 'check',
                'default' => 1,
            ],
        ],
        'is_visible' => [
            'label' => 'Visible Publicly?',
            'config' => [
                'type' => 'check',
                'default' => 1,
            ],
        ],
        'slug' => [
            'label' => 'URL Slug',
            'config' => [
                'type' => 'input',
                'eval' => 'unique,trim',
            ],
        ],
        'uuid' => [
            'label' => 'UUID',
            'config' => [
                'type' => 'input',
                'eval' => 'required,unique,trim',
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
        'tx_equedlms_domain_model_coursebundle',
        '--div--;General,
        title, description, course_programs, price, discount_percentage,
        is_active, is_visible, slug, uuid, created_at, updated_at'
    );
})();
