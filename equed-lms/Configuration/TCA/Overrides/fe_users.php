<?php
defined('TYPO3_MODE') or die();

// Add a field for tracking the last login date of a frontend user
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'fe_users',
    [
        'last_login' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:fe_users.last_login',
            'config' => [
                'type' => 'input',
                'size' => 10,
                'eval' => 'datetime',
                'default' => 0,
            ],
        ],
    ]
);

// Add the new field to the backend form
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    'last_login',
    '',
    'after:crdate'
);