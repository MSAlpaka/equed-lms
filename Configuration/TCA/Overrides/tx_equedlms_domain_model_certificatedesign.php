
<?php
defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(function () {
    ExtensionManagementUtility::addTCAcolumns('tx_equedlms_domain_model_certificatedesign', [
        'title' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.title',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,required',
            ],
        ],
        'certificate_type' => [
            'label' => 'Certificate Type',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['Course Certificate', 'course'],
                    ['Specialty Certificate', 'specialty'],
                    ['Recognition Award', 'award'],
                    ['Custom / Other', 'custom'],
                ],
                'default' => 'course',
            ],
        ],
        'background_image' => [
            'label' => 'Background Image (PDF Template)',
            'config' => [
                'type' => 'file',
                'maxitems' => 1,
                'allowed' => ['jpg', 'jpeg', 'png', 'pdf'],
            ],
        ],
        'font_family' => [
            'label' => 'Font Family',
            'config' => [
                'type' => 'input',
                'default' => 'Manrope',
                'eval' => 'trim',
            ],
        ],
        'text_color' => [
            'label' => 'Text Color (Hex)',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
                'default' => '#000000',
            ],
        ],
        'position_name' => [
            'label' => 'Position: Name',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ],
        ],
        'position_date' => [
            'label' => 'Position: Date',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ],
        ],
        'position_course' => [
            'label' => 'Position: Course Title',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ],
        ],
        'position_signature' => [
            'label' => 'Position: Signature Field',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ],
        ],
        'position_qr' => [
            'label' => 'Position: QR Code',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ],
        ],
        'position_logo' => [
            'label' => 'Position: Logo',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ],
        ],
        'preview_sample' => [
            'label' => 'Preview Sample (Optional)',
            'config' => [
                'type' => 'file',
                'maxitems' => 1,
            ],
        ],
        'is_active' => [
            'label' => 'Is Active',
            'config' => [
                'type' => 'check',
                'default' => 1,
            ],
        ],
        'applies_to_course' => [
            'label' => 'Applies to CourseProgram',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_equedlms_domain_model_courseprogram',
                'maxitems' => 99,
                'appearance' => [
                    'collapseAll' => true,
                    'newRecordLinkAddTitle' => true,
                ],
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
    ]);

    ExtensionManagementUtility::addToAllTCAtypes(
        'tx_equedlms_domain_model_certificatedesign',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        title, certificate_type, background_image, font_family, text_color,
        position_name, position_date, position_course, position_signature,
        position_qr, position_logo, preview_sample, applies_to_course,
        is_active, language, uuid, created_at'
    );
})();
