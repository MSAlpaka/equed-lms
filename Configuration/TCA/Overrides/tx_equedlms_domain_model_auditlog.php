
<?php
defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(function () {
    ExtensionManagementUtility::addTCAcolumns('tx_equedlms_domain_model_auditlog', [
        'timestamp' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.timestamp',
            'config' => [
                'type' => 'datetime',
                'required' => true,
            ],
        ],
        'action_type' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:auditlog.action_type',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['Certificate issued', 'certificate_issued'],
                    ['Course validated', 'course_validated'],
                    ['QMS case opened', 'qms_case_opened'],
                    ['Course marked as passed', 'course_passed'],
                    ['Submission uploaded', 'submission_uploaded'],
                    ['Instructor feedback added', 'instructor_feedback'],
                    ['Badge awarded', 'badge_awarded'],
                    ['Course booking created', 'course_booked'],
                    ['System notice', 'system_event']
                ],
                'default' => 'system_event',
            ],
        ],
        'target_model' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:auditlog.target_model',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,required',
            ],
        ],
        'target_uid' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.uid',
            'config' => [
                'type' => 'number',
                'required' => true,
            ],
        ],
        'initiator_type' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:auditlog.initiator_type',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['System', 'system'],
                    ['User', 'user'],
                    ['Instructor', 'instructor'],
                    ['Certifier', 'certifier'],
                    ['Admin', 'admin'],
                    ['ServiceCenter', 'servicecenter'],
                ],
                'default' => 'system',
            ],
        ],
        'initiator_uid' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.fe_user',
            'config' => [
                'type' => 'number',
            ],
        ],
        'log_level' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_common.xlf:log_level',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['Info', 'info'],
                    ['Warning', 'warning'],
                    ['Critical', 'critical'],
                ],
                'default' => 'info',
            ],
        ],
        'message' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.message',
            'config' => [
                'type' => 'text',
                'rows' => 4,
                'cols' => 60,
            ],
        ],
        'meta_data' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:auditlog.meta_data',
            'config' => [
                'type' => 'text',
            ],
        ],
        'related_qms_case' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:auditlog.related_qms_case',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_qmscase',
                'maxitems' => 1,
            ],
        ],
        'is_hidden' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_common.xlf:label.hidden',
            'config' => [
                'type' => 'check',
            ],
        ],
        'is_automated' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:auditlog.is_automated',
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
    ]);

    ExtensionManagementUtility::addToAllTCAtypes(
        'tx_equedlms_domain_model_auditlog',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        timestamp, action_type, target_model, target_uid, initiator_type, initiator_uid,
        log_level, message, meta_data, related_qms_case, is_hidden, is_automated, uuid'
    );
})();
