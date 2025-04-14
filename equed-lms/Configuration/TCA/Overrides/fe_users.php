<?php

defined('TYPO3') or die();

$GLOBALS['TCA']['fe_users']['columns'] ??= [];

$GLOBALS['TCA']['fe_users']['columns']['is_certifier'] = [
    'exclude' => true,
    'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:fe_users.is_certifier',
    'config' => ['type' => 'check', 'default' => 0],
];

$GLOBALS['TCA']['fe_users']['columns']['step1_complete'] = [
    'exclude' => true,
    'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:fe_users.step1_complete',
    'config' => ['type' => 'check', 'default' => 0],
];

$GLOBALS['TCA']['fe_users']['columns']['step2_complete'] = [
    'exclude' => true,
    'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:fe_users.step2_complete',
    'config' => ['type' => 'check', 'default' => 0],
];

$GLOBALS['TCA']['fe_users']['columns']['onboarding_complete'] = [
    'exclude' => true,
    'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:fe_users.onboarding_complete',
    'config' => ['type' => 'check', 'default' => 0],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    'is_certifier, step1_complete, step2_complete, onboarding_complete',
    '',
    'after:email'
);