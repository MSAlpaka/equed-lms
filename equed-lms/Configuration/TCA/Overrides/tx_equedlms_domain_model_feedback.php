<?php

defined('TYPO3') or die();

$GLOBALS['TCA']['tx_equedlms_domain_model_feedback']['columns'] ??= [];

$GLOBALS['TCA']['tx_equedlms_domain_model_feedback']['columns']['user_feedback'] = [
    'exclude' => true,
    'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_feedback.user_feedback',
    'config' => [
        'type' => 'text',
        'rows' => 5,
        'eval' => 'trim',
    ],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tx_equedlms_domain_model_feedback',
    'user_feedback',
    '',
    'after:rating'
);