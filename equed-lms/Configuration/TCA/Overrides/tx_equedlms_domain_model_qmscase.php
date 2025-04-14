<?php

defined('TYPO3') or die();

$GLOBALS['TCA']['tx_equedlms_domain_model_qmscase']['columns'] ??= [];

$GLOBALS['TCA']['tx_equedlms_domain_model_qmscase']['columns']['severity_level'] = [
    'exclude' => true,
    'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_qmscase.severity_level',
    'config' => [
        'type' => 'select',
        'renderType' => 'selectSingle',
        'items' => [
            ['Low', 1],
            ['Medium', 2],
            ['High', 3],
        ],
        'default' => 1,
    ],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tx_equedlms_domain_model_qmscase',
    'severity_level',
    '',
    'after:status'
);