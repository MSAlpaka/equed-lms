
<?php
defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(function () {
    ExtensionManagementUtility::addTCAcolumns('tx_equedlms_domain_model_usercourserecord', [
        'fe_user' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:usercourserecord.fe_user',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'maxitems' => 1,
                'minitems' => 1,
            ],
        ],
        'course_instance' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:usercourserecord.course_instance',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_courseinstance',
                'maxitems' => 1,
                'minitems' => 1,
            ],
        ],
        'progress' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:usercourserecord.progress',
            'config' => [
                'type' => 'number',
                'range' => [
                    'lower' => 0,
                    'upper' => 100,
                ],
                'default' => 0,
            ],
        ],
        'status' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:usercourserecord.status',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['In Progress', 'in_progress'],
                    ['Submitted', 'submitted'],
                    ['Instructor Confirmed', 'confirmed'],
                    ['Validated', 'validated'],
                    ['Certified', 'certified'],
                    ['Rejected', 'rejected'],
                ],
                'default' => 'in_progress',
            ],
        ],
        'certification_code' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:usercourserecord.certification_code',
            'config' => [
                'type' => 'input',
                'readOnly' => true,
            ],
        ],
        'certificate_file' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:usercourserecord.certificate_file',
            'config' => [
                'type' => 'file',
                'appearance' => [
                    'createNewRelationLinkTitle' => 'LLL:EXT:core/Resources/Private/Language/locallang_core.xlf:cm.createNewRelation',
                ],
                'maxitems' => 1,
            ],
        ],
        'onboarding_complete' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:usercourserecord.onboarding_complete',
            'config' => [
                'type' => 'check',
                'items' => [
                    ['LLL:EXT:core/Resources/Private/Language/locallang_core.xlf:labels.enabled', 1]
                ],
            ],
        ],
        'final_validation_date' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:usercourserecord.final_validation_date',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'notes' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:usercourserecord.notes',
            'config' => [
                'type' => 'text',
                'rows' => 5,
                'cols' => 40,
            ],
        ],
    ]);

    ExtensionManagementUtility::addToAllTCAtypes(
        'tx_equedlms_domain_model_usercourserecord',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
         fe_user, course_instance, progress, status, certification_code, certificate_file, onboarding_complete, final_validation_date, notes'
    );
})();
