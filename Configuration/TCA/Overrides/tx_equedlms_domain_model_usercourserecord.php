
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
            ],
        ],
        'enrolled_at' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:usercourserecord.enrolled_at',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'status' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:usercourserecord.status',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['Aktiv', 'aktiv'],
                    ['Abgeschlossen', 'abgeschlossen'],
                    ['Abgebrochen', 'abgebrochen'],
                    ['Nicht bestanden', 'nicht_bestanden'],
                ],
                'default' => 'aktiv',
            ],
        ],
        'progress_percent' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:usercourserecord.progress_percent',
            'config' => [
                'type' => 'number',
                'range' => ['lower' => 0, 'upper' => 100],
                'default' => 0,
            ],
        ],
        'certified_at' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:usercourserecord.certified_at',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'certifier' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:usercourserecord.certifier',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'maxitems' => 1,
            ],
        ],
        'instructor' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:usercourserecord.instructor',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'maxitems' => 1,
            ],
        ],
        'requires_external_examiner' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:usercourserecord.requires_external_examiner',
            'config' => [
                'type' => 'check',
            ],
        ],
        'external_examiner' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:usercourserecord.external_examiner',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'maxitems' => 1,
            ],
        ],
        'validation_required' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:usercourserecord.validation_required',
            'config' => [
                'type' => 'check',
                'default' => 1,
            ],
        ],
        'validated_by' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:usercourserecord.validated_by',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'maxitems' => 1,
            ],
        ],
        'validated_at' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:usercourserecord.validated_at',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'certificate_file' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:usercourserecord.certificate_file',
            'config' => [
                'type' => 'file',
                'appearance' => [
                    'createNewRelationLinkTitle' => 'Datei hochladen',
                ],
                'maxitems' => 1,
            ],
        ],
        'certificate_code' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:usercourserecord.certificate_code',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,unique',
            ],
        ],
        'qms_flagged' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:usercourserecord.qms_flagged',
            'config' => [
                'type' => 'check',
            ],
        ],
        'qms_case' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:usercourserecord.qms_case',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_qmscase',
                'maxitems' => 1,
            ],
        ],
        'note_internal' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:usercourserecord.note_internal',
            'config' => [
                'type' => 'text',
                'rows' => 3,
                'cols' => 60,
            ],
        ],
        'attempts_total' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:usercourserecord.attempts_total',
            'config' => [
                'type' => 'number',
                'default' => 1,
            ],
        ],
        'last_activity' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:usercourserecord.last_activity',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'recognition_awarded' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:usercourserecord.recognition_awarded',
            'config' => [
                'type' => 'check',
            ],
        ],
    ]);

    ExtensionManagementUtility::addToAllTCAtypes(
        'tx_equedlms_domain_model_usercourserecord',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        fe_user, course_instance, enrolled_at, status, progress_percent, last_activity,
        instructor, certifier, certified_at, certificate_file, certificate_code,
        requires_external_examiner, external_examiner, validation_required,
        validated_by, validated_at, qms_flagged, qms_case, note_internal, attempts_total, recognition_awarded'
    );
})();
