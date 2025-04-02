<?php

defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

// Bestehendes Feld "is_certifier"
$GLOBALS['TCA']['fe_users']['columns']['is_certifier'] = [
    'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:fe_users.is_certifier',
    'config' => [
        'type' => 'check',
        'default' => 0,
    ],
];

// Neue Felder für das Onboarding
$GLOBALS['TCA']['fe_users']['columns']['step1_complete'] = [
    'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:fe_users.step1_complete',
    'config' => [
        'type' => 'check',
        'default' => 0,
    ],
];

$GLOBALS['TCA']['fe_users']['columns']['step2_complete'] = [
    'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:fe_users.step2_complete',
    'config' => [
        'type' => 'check',
        'default' => 0,
    ],
];

$GLOBALS['TCA']['fe_users']['columns']['step3_complete'] = [
    'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:fe_users.step3_complete',
    'config' => [
        'type' => 'check',
        'default' => 0,
    ],
];

ExtensionManagementUtility::addToAllTCAtypes('fe_users', 'step1_complete', '', 'after:onboarding_complete');
ExtensionManagementUtility::addToAllTCAtypes('fe_users', 'step2_complete', '', 'after:step1_complete');
ExtensionManagementUtility::addToAllTCAtypes('fe_users', 'step3_complete', '', 'after:step2_complete');