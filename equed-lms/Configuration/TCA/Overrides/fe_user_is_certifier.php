<?php
defined('TYPO3_MODE') or die();

// Add a field to mark a FE user as a certifier
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'fe_users',
    [
        'is_certifier' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:fe_users.is_certifier',
            'config' => [
                'type' => 'check',
                'eval' => '',
            ],
        ],
    ]
);

// Add the new field to the backend form
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    'is_certifier',
    '',
    'after:admin'
);