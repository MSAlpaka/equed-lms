<?php

defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

// Bestehendes Feld "is_certifier" bleibt erhalten
$GLOBALS['TCA']['fe_users']['columns']['is_certifier'] = [
    'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:fe_users.is_certifier',
    'config' => [
        'type' => 'check',
        'default' => 0,
    ],
];

// NEUES Feld: "photo"
$GLOBALS['TCA']['fe_users']['columns']['photo'] = [
    'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:fe_users.photo',
    'config' => [
        'type' => 'file',
        'appearance' => [
            'createNewRelationLinkTitle' =>
                'LLL:EXT:core/Resources/Private/Language/locallang_core.xlf:labels.addFileReference'
        ],
        'allowed' => 'jpg,jpeg,png,gif',
        'maxitems' => 1,
    ],
];

ExtensionManagementUtility::addToAllTCAtypes('fe_users', 'is_certifier', '', 'after:username');
ExtensionManagementUtility::addToAllTCAtypes('fe_users', 'photo', '', 'after:name');

// NEUES FELD: Onboarding-Status
$GLOBALS['TCA']['fe_users']['columns']['onboarding_complete'] = [
    'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:fe_users.onboarding_complete',
    'config' => [
        'type' => 'check',
        'default' => 0,
    ],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    'onboarding_complete',
    '',
    'after:is_instructor'
);