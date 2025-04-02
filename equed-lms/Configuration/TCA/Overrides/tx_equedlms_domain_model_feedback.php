<?php
defined('TYPO3_MODE') or die();

// Add a custom field to feedback for storing user feedback
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'tx_equedlms_domain_model_feedback',
    [
        'user_feedback' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_feedback.user_feedback',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 5,
                'eval' => 'trim',
            ],
        ],
    ]
);

// Add the new field to the backend form
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tx_equedlms_domain_model_feedback',
    'user_feedback',
    '',
    'after:rating'
);