
<?php
defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(function () {
    ExtensionManagementUtility::addTCAcolumns('tx_equedlms_domain_model_courseinstance', [
        'course_program' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseinstance.course_program',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_courseprogram',
                'maxitems' => 1,
                'minitems' => 1,
            ],
        ],
        'title_suffix' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseinstance.title_suffix',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ],
        ],
        'training_center' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseinstance.training_center',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_groups',
                'maxitems' => 1,
            ],
        ],
        'start_date' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseinstance.start_date',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'end_date' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseinstance.end_date',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'location' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseinstance.location',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ],
        ],
        'instructors' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseinstance.instructors',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_equedlms_domain_model_instructorassignment',
                'foreign_field' => 'course_instance',
                'maxitems' => 20,
            ],
        ],
        'max_participants' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseinstance.max_participants',
            'config' => [
                'type' => 'number',
                'default' => 10,
            ],
        ],
        'visible_in_calendar' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseinstance.visible_in_calendar',
            'config' => [
                'type' => 'check',
                'default' => 1,
            ],
        ],
        'online_course' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseinstance.online_course',
            'config' => [
                'type' => 'check',
            ],
        ],
        'enrollment_deadline' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseinstance.enrollment_deadline',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'status' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseinstance.status',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['Geplant', 'planned'],
                    ['Laufend', 'active'],
                    ['Abgeschlossen', 'completed'],
                    ['Abgesagt', 'cancelled'],
                ],
                'default' => 'planned',
            ],
        ],
        'notes_admin' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseinstance.notes_admin',
            'config' => [
                'type' => 'text',
                'rows' => 3,
                'cols' => 60,
            ],
        ],
    ]);

    ExtensionManagementUtility::addToAllTCAtypes(
        'tx_equedlms_domain_model_courseinstance',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        course_program, title_suffix, training_center, start_date, end_date, location,
        max_participants, online_course, enrollment_deadline, status, visible_in_calendar, notes_admin,
        instructors'
    );
})();
