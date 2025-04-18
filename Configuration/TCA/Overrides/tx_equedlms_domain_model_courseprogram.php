
<?php
defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(function () {
    ExtensionManagementUtility::addTCAcolumns('tx_equedlms_domain_model_courseprogram', [
        'title' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseprogram.title',
            'config' => [
                'type' => 'input',
                'required' => true,
                'eval' => 'trim',
            ],
        ],
        'subtitle' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseprogram.subtitle',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ],
        ],
        'description' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseprogram.description',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'rows' => 10,
                'cols' => 80,
            ],
        ],
        'duration_hours' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseprogram.duration_hours',
            'config' => [
                'type' => 'number',
            ],
        ],
        'level' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseprogram.level',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['Intro', 'intro'],
                    ['Basic', 'basic'],
                    ['Specialist', 'specialist'],
                    ['Techniques', 'techniques'],
                    ['Instructor', 'instructor'],
                    ['Specialty', 'specialty'],
                ],
                'renderType' => 'selectSingle',
            ],
        ],
        'requirements' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseprogram.requirements',
            'config' => [
                'type' => 'text',
                'rows' => 5,
                'cols' => 80,
            ],
        ],
        'goals' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseprogram.goals',
            'config' => [
                'type' => 'text',
                'rows' => 5,
                'cols' => 80,
            ],
        ],
        'certificate_type' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseprogram.certificate_type',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['Teilnahmebestätigung', 'confirmation'],
                    ['Zertifikat', 'certificate'],
                    ['Specialty Badge', 'badge'],
                ],
                'renderType' => 'selectSingle',
            ],
        ],
        'requires_external_examiner' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseprogram.requires_external_examiner',
            'config' => [
                'type' => 'check',
            ],
        ],
        'certifier_must_validate' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseprogram.certifier_must_validate',
            'config' => [
                'type' => 'check',
            ],
        ],
        'recertification_required' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseprogram.recertification_required',
            'config' => [
                'type' => 'check',
            ],
        ],
        'recertification_interval_years' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseprogram.recertification_interval_years',
            'config' => [
                'type' => 'number',
                'default' => 0,
            ],
        ],
        'badge_icon' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseprogram.badge_icon',
            'config' => [
                'type' => 'file',
                'maxitems' => 1,
            ],
        ],
        'visible_in_catalog' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseprogram.visible_in_catalog',
            'config' => [
                'type' => 'check',
                'default' => 1,
            ],
        ],
        'sort_order' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:courseprogram.sort_order',
            'config' => [
                'type' => 'number',
                'default' => 100,
            ],
        ],
    ]);

    ExtensionManagementUtility::addToAllTCAtypes(
        'tx_equedlms_domain_model_courseprogram',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        title, subtitle, description, duration_hours, level, requirements, goals, certificate_type,
        requires_external_examiner, certifier_must_validate, recertification_required, recertification_interval_years,
        badge_icon, visible_in_catalog, sort_order'
    );
})();
