
<?php
defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(function () {
    ExtensionManagementUtility::addTCAcolumns('tx_equedlms_domain_model_submission', [
        'user_course_record' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:submission.user_course_record',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_usercourserecord',
                'maxitems' => 1,
                'minitems' => 1,
            ],
        ],
        'lesson' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:submission.lesson',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_lesson',
                'maxitems' => 1,
            ],
        ],
        'type' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:submission.type',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['Reflexion', 'reflexion'],
                    ['Testantwort', 'test'],
                    ['Fallbericht', 'fallbericht'],
                    ['Upload', 'upload'],
                    ['Dokumentation', 'dokumentation']
                ],
                'default' => 'upload',
            ],
        ],
        'text_response' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:submission.text_response',
            'config' => [
                'type' => 'text',
                'rows' => 10,
                'cols' => 80,
            ],
        ],
        'file' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:submission.file',
            'config' => [
                'type' => 'file',
                'appearance' => [
                    'createNewRelationLinkTitle' => 'LLL:EXT:core/Resources/Private/Language/locallang_core.xlf:cm.createNewRelation'
                ],
                'maxitems' => 10
            ],
        ],
        'status' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:submission.status',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['Eingereicht', 'eingereicht'],
                    ['Angenommen', 'angenommen'],
                    ['Zurückgewiesen', 'zurueckgewiesen'],
                    ['Wiederholung erforderlich', 'wiederholung'],
                ],
                'default' => 'eingereicht',
            ],
        ],
        'feedback' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:submission.feedback',
            'config' => [
                'type' => 'text',
                'rows' => 5,
                'cols' => 80,
            ],
        ],
        'instructor' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:submission.instructor',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'maxitems' => 1,
            ],
        ],
        'submitted_at' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:submission.submitted_at',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'reviewed_at' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:submission.reviewed_at',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'attempt_number' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:submission.attempt_number',
            'config' => [
                'type' => 'number',
                'default' => 1,
            ],
        ],
        'evaluation_score' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:submission.evaluation_score',
            'config' => [
                'type' => 'number',
                'default' => 0,
            ],
        ],
        'is_repeatable' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:submission.is_repeatable',
            'config' => [
                'type' => 'check',
            ],
        ],
        'comment_internal' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:submission.comment_internal',
            'config' => [
                'type' => 'text',
                'rows' => 3,
                'cols' => 60,
            ],
        ],
        'visibility' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:submission.visibility',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['Nur Teilnehmende', 'participant'],
                    ['Instructor & TN', 'both'],
                    ['Instructor, TN, QMS', 'all'],
                ],
                'default' => 'both',
            ],
        ],
        'qms_flagged' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:submission.qms_flagged',
            'config' => [
                'type' => 'check',
            ],
        ],
        'qms_case' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:submission.qms_case',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_qmscase',
                'maxitems' => 1,
            ],
        ],
        'last_modified_by' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:submission.last_modified_by',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'maxitems' => 1,
            ],
        ],
    ]);

    ExtensionManagementUtility::addToAllTCAtypes(
        'tx_equedlms_domain_model_submission',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        user_course_record, lesson, type, text_response, file, status, feedback, instructor,
        submitted_at, reviewed_at, attempt_number, evaluation_score, is_repeatable,
        comment_internal, visibility, qms_flagged, qms_case, last_modified_by'
    );
})();
