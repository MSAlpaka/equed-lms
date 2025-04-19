
<?php
defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(function () {
    ExtensionManagementUtility::addTCAcolumns('tx_equedlms_domain_model_coursecertificate', [
        'user_course_record' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:coursecertificate.user_course_record',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_usercourserecord',
                'maxitems' => 1,
            ],
        ],
        'course_instance' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:coursecertificate.course_instance',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_courseinstance',
                'maxitems' => 1,
            ],
        ],
        'frontend_user' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:coursecertificate.frontend_user',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'maxitems' => 1,
            ],
        ],
        'certifier_user' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:coursecertificate.certifier_user',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'maxitems' => 1,
            ],
        ],
        'instructor_user' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:coursecertificate.instructor_user',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'maxitems' => 1,
            ],
        ],
        'certificate_number' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:coursecertificate.certificate_number',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,required,unique',
            ],
        ],
        'issued_at' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:coursecertificate.issued_at',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'validated_at' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:coursecertificate.validated_at',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'is_validated' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:coursecertificate.is_validated',
            'config' => [
                'type' => 'check',
            ],
        ],
        'is_revoked' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:coursecertificate.is_revoked',
            'config' => [
                'type' => 'check',
            ],
        ],
        'revocation_reason' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:coursecertificate.revocation_reason',
            'config' => [
                'type' => 'text',
                'rows' => 3,
                'cols' => 80,
            ],
        ],
        'certificate_pdf' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:coursecertificate.certificate_pdf',
            'config' => [
                'type' => 'file',
                'maxitems' => 1,
                'appearance' => [
                    'createNewRelationLinkTitle' => 'PDF hinzufügen',
                ],
            ],
        ],
        'badge_url' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:coursecertificate.badge_url',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ],
        ],
        'public_certificate_url' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:coursecertificate.public_certificate_url',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ],
        ],
        'show_in_profile' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:coursecertificate.show_in_profile',
            'config' => [
                'type' => 'check',
                'default' => 1,
            ],
        ],
        'qms_flagged' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:coursecertificate.qms_flagged',
            'config' => [
                'type' => 'check',
            ],
        ],
        'qms_case' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:coursecertificate.qms_case',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_qmscase',
                'maxitems' => 1,
            ],
        ],
        'metadata_json' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:coursecertificate.metadata_json',
            'config' => [
                'type' => 'text',
                'enableRichtext' => false,
                'rows' => 5,
                'cols' => 80,
            ],
        ],
        'tags' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:coursecertificate.tags',
            'config' => [
                'type' => 'text',
                'rows' => 2,
                'cols' => 60,
            ],
        ],
        'expires_at' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:coursecertificate.expires_at',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'renewed_from' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:coursecertificate.renewed_from',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_coursecertificate',
                'maxitems' => 1,
            ],
        ],
        'recognition_level' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:coursecertificate.recognition_level',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['Keiner', 'none'],
                    ['Basic', 'basic'],
                    ['Specialty', 'specialty'],
                    ['Advanced', 'advanced'],
                    ['Instructor', 'instructor'],
                ],
                'default' => 'basic',
            ],
        ],
    ]);

    ExtensionManagementUtility::addToAllTCAtypes(
        'tx_equedlms_domain_model_coursecertificate',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        user_course_record, course_instance, frontend_user, certifier_user, instructor_user,
        certificate_number, issued_at, validated_at, is_validated, is_revoked, revocation_reason,
        certificate_pdf, badge_url, public_certificate_url, show_in_profile,
        qms_flagged, qms_case, metadata_json, tags, expires_at, renewed_from, recognition_level'
    );
})();
