
<?php
defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(function () {
    ExtensionManagementUtility::addTCAcolumns('tx_equedlms_domain_model_appsyncqueue', [
        'user' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.fe_user',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'maxitems' => 1,
            ],
        ],
        'sync_type' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:appsyncqueue.sync_type',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['Lesson Progress', 'course_progress'],
                    ['Quiz Attempt', 'quiz_answer'],
                    ['File Upload', 'file_upload'],
                    ['Submission', 'submission'],
                    ['Exam Attempt', 'exam_attempt'],
                    ['Feedback', 'feedback'],
                    ['Booking Request', 'booking_request'],
                ],
                'default' => 'course_progress',
            ],
        ],
        'related_model' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:appsyncqueue.related_model',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ],
        ],
        'related_uid' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.uid',
            'config' => [
                'type' => 'number',
            ],
        ],
        'payload_json' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:appsyncqueue.payload_json',
            'config' => [
                'type' => 'text',
            ],
        ],
        'status' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_common.xlf:status',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['Pending', 'pending'],
                    ['Synced', 'synced'],
                    ['Failed', 'failed'],
                    ['Conflict', 'conflict'],
                ],
                'default' => 'pending',
            ],
        ],
        'retry_count' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:appsyncqueue.retry_count',
            'config' => [
                'type' => 'number',
                'default' => 0,
            ],
        ],
        'last_attempt_at' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.lastUpdate',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'created_at' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.creationDate',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'uuid' => [
            'label' => 'UUID',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,unique,required',
            ],
        ],
        'is_critical' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:appsyncqueue.is_critical',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'device_id' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:appsyncqueue.device_id',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ],
        ],
        'app_version' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:appsyncqueue.app_version',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ],
        ],
        'error_message' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.message',
            'config' => [
                'type' => 'text',
                'rows' => 3,
                'cols' => 60,
            ],
        ],
        'resolution_hint' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:appsyncqueue.resolution_hint',
            'config' => [
                'type' => 'text',
                'rows' => 2,
                'cols' => 60,
            ],
        ],
    ]);

    ExtensionManagementUtility::addToAllTCAtypes(
        'tx_equedlms_domain_model_appsyncqueue',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        user, sync_type, related_model, related_uid, payload_json, status, retry_count,
        last_attempt_at, created_at, uuid, is_critical, device_id, app_version,
        error_message, resolution_hint'
    );
})();
