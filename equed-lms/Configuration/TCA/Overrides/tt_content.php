<?php

defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

// Admin-Visibility-Feld hinzufügen
$GLOBALS['TCA']['tt_content']['columns']['admin_visibility'] = [
    'exclude' => true,
    'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tt_content.admin_visibility',
    'config' => [
        'type' => 'check',
        'default' => 0,
    ],
];

ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    'admin_visibility',
    '',
    'after:header'
);

// Plugin Registration (CType)
$plugins = [
    ['Course Plugin', 'equedlms_course', 'PluginCourse.svg'],
    ['Lesson Plugin', 'equedlms_lesson', 'PluginLesson.svg'],
    ['Submission Plugin', 'equedlms_submission', 'PluginSubmission.svg'],
    ['Certifier Plugin', 'equedlms_certifier', 'PluginCertifier.svg'],
    ['Certificate Plugin', 'equedlms_certificate', 'PluginCertificate.svg'],
];

foreach ($plugins as [$label, $ctype, $icon]) {
    ExtensionManagementUtility::addPlugin(
        [$label, $ctype, 'EXT:equed_lms/Resources/Public/Icons/' . $icon],
        'CType',
        'equed_lms'
    );
}