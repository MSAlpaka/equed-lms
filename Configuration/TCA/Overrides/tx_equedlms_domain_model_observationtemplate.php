
<?php
defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(function () {
    ExtensionManagementUtility::addTCAcolumns('tx_equedlms_domain_model_observationtemplate', [
        'title' => [
            'label' => 'Title',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,required',
            ],
        ],
        'description' => [
            'label' => 'Description',
            'config' => [
                'type' => 'text',
                'rows' => 4,
                'enableRichtext' => true,
            ],
        ],
        'course_program' => [
            'label' => 'Course Program',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_equedlms_domain_model_courseprogram',
                'renderType' => 'selectSingle',
            ],
        ],
        'specialty_program' => [
            'label' => 'Specialty Program (optional)',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_equedlms_domain_model_specialtyprogram',
                'renderType' => 'selectSingle',
            ],
        ],
        'field_structure' => [
            'label' => 'Field Structure (JSON)',
            'config' => [
                'type' => 'text',
                'rows' => 10,
                'eval' => 'trim',
            ],
        ],
        'allow_file_upload' => [
            'label' => 'Allow File Uploads',
            'config' => [
                'type' => 'check',
                'default' => 1,
            ],
        ],
        'assignable_to_course' => [
            'label' => 'Manually Assignable to Course',
            'config' => [
                'type' => 'check',
                'default' => 1,
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
        'version' => [
            'label' => 'Version',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
                'default' => '1.0',
            ],
        ],
        'is_active' => [
            'label' => 'Active',
            'config' => [
                'type' => 'check',
                'default' => 1,
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
        'updated_at' => [
            'label' => 'Updated At',
            'config' => [
                'type' => 'datetime',
            ],
        ],
    ]);

    ExtensionManagementUtility::addToAllTCAtypes(
        'tx_equedlms_domain_model_observationtemplate',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        title, description, course_program, specialty_program, field_structure,
        allow_file_upload, assignable_to_course, available_from, available_until,
        version, is_active, language, uuid, created_at, updated_at'
    );
})();
