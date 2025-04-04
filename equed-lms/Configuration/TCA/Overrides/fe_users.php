<?php

defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

$additionalColumns = [
    'is_certifier' => [
        'exclude' => true,
        'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:fe_users.is_certifier',
        'config' => [
            'type' => 'check',
            'default' => 0,
        ],
    ],
    'step1_complete' => [
        'exclude' => true,
        'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:fe_users.step1_complete',
        'config' => [
            'type' => 'check',
            'default' => 0,
        ],
    ],
    'step2_complete' => [
        'exclude' => true,
        'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:fe_users.step2_complete',
        'config' => [
            'type' => 'check',
            'default' => 0,
        ],
    ],
    'onboarding_complete' => [
        'exclude' => true,
        'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:fe_users.onboarding_complete',
        'config' => [
            'type' => 'check',
            'default' => 0,
        ],
    ],
];

ExtensionManagementUtility::addTCAcolumns('fe_users', $additionalColumns);

// Optional: Ausgabe in allen TCA-Typen sichtbar machen
ExtensionManagementUtility::addToAllTCAtypes('fe_users', '
    --div--;LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:fe_users.tab_equed,
    is_certifier, step1_complete, step2_complete, onboarding_complete
');