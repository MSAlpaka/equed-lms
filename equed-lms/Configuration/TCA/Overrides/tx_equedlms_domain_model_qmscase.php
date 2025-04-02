<?php
defined('TYPO3_MODE') or die();

// Add a custom field for QMS case severity
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'tx_equedlms_domain_model_qmscase',
    [
        'severity_level' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_qmscase.severity_level',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['Low', 1],
                    ['Medium', 2],
                    ['High', 3],
                ],
                'size' => 1,
                'maxitems' => 1,
            ],
        ],
    ]
);

// Add the new field to the backend form
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tx_equedlms_domain_model_qmscase',
    'severity_level',
    '',
    'after:title'
);