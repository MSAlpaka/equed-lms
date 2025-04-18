
<?php
defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(function () {
    ExtensionManagementUtility::addTCAcolumns('tx_equedlms_domain_model_courseinstance', [
        'program' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseinstance.program',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_courseprogram',
                'foreign_table' => 'tx_equedlms_domain_model_courseprogram',
                'maxitems' => 1,
                'minitems' => 1,
            ],
        ],
        'training_center' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseinstance.training_center',
            'config' => [
                'type' => 'input',
            ],
        ],
        'instructor' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseinstance.instructor',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'maxitems' => 1,
                'minitems' => 0,
            ],
        ],
        'start_date' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseinstance.start_date',
            'config' => [
                'type' => 'datetime',
                'required' => true,
            ],
        ],
        'end_date' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseinstance.end_date',
            'config' => [
                'type' => 'datetime',
                'required' => true,
            ],
        ],
        'external_examiner_required' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseinstance.external_examiner_required',
            'config' => [
                'type' => 'check',
                'items' => [
                    ['LLL:EXT:core/Resources/Private/Language/locallang_core.xlf:labels.enabled', 1]
                ]
            ],
        ],
        'examiner_assigned' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseinstance.examiner_assigned',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'maxitems' => 1,
            ],
        ],
        'status' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseinstance.status',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['-- Label --', ''],
                    ['Planned', 'planned'],
                    ['Active', 'active'],
                    ['Finished', 'finished'],
                    ['Cancelled', 'cancelled'],
                ],
                'default' => 'planned'
            ],
        ],
    ]);

    ExtensionManagementUtility::addToAllTCAtypes(
        'tx_equedlms_domain_model_courseinstance',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
         program, training_center, instructor, start_date, end_date, external_examiner_required, examiner_assigned, status'
    );
})();
