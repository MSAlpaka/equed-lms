<?php
defined('TYPO3_MODE') or die();

// Add a new field to tt_content for custom course content
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'tt_content',
    [
        'course_material' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tt_content.course_material',
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
    'tt_content',
    'course_material',
    '',
    'after:header'
);