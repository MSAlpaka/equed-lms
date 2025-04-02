<?php
defined('TYPO3_MODE') or die();

// Add a new field to tt_content for admin-related content visibility
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'tt_content',
    [
        'admin_visibility' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tt_content.admin_visibility',
            'config' => [
                'type' => 'check',
                'eval' => '',
            ],
        ],
    ]
);

// Add the new field to the backend form
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    'admin_visibility',
    '',
    'after:header'
);