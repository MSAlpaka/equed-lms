<?php

defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Imaging\IconRegistry;

$extensionKey = 'equed_lms';

// -------------------------------
// Register all CType content elements
// -------------------------------

$pluginTypes = [
    'equedlms_course' => 'plugin.course.title',
    'equedlms_lesson' => 'plugin.lesson.title',
    'equedlms_courseoverview' => 'plugin.courseoverview.title',
    'equedlms_coursebooking' => 'plugin.coursebooking.title',
    'equedlms_certificates' => 'plugin.certificates.title',
    'equedlms_userdashboard' => 'plugin.userdashboard.title',
    'equedlms_qmsincidentform' => 'plugin.qmsincidentform.title'
];

foreach ($pluginTypes as $cType => $labelKey) {
    ExtensionManagementUtility::addPlugin(
        [
            'LLL:EXT:' . $extensionKey . '/Resources/Private/Language/locallang_db.xlf:' . $labelKey,
            $cType,
            'content-' . $cType
        ],
        'CType'
    );

    $GLOBALS['TCA']['tt_content']['types'][$cType] = [
        'showitem' => '--palette--;;general, --palette--;;headers, bodytext, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, hidden',
    ];

    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes'][$cType] = 'content-' . $cType;
}

// -------------------------------
// Icon Registration for Content Types
// -------------------------------

$iconRegistry = GeneralUtility::makeInstance(IconRegistry::class);

foreach (array_keys($pluginTypes) as $cType) {
    $iconRegistry->registerIcon(
        'content-' . $cType,
        SvgIconProvider::class,
        ['source' => 'EXT:' . $extensionKey . '/Resources/Public/Icons/' . $cType . '.svg']
    );
}

// -------------------------------
// Icon Registration for FE User Roles (Instructor, Certifier, ServiceCenter)
// -------------------------------

$userRoles = [
    'user-instructor' => 'user-instructor.svg',
    'user-certifier' => 'user-certifier.svg',
    'user-servicecenter' => 'user-servicecenter.svg'
];

foreach ($userRoles as $identifier => $file) {
    $iconRegistry->registerIcon(
        $identifier,
        SvgIconProvider::class,
        ['source' => 'EXT:' . $extensionKey . '/Resources/Public/Icons/' . $file]
    );
}

// -------------------------------
// Optional Backend Module: ServiceCenter
// -------------------------------

if (TYPO3_MODE === 'BE' && class_exists(\Equed\EquedLms\Controller\ServiceCenterController::class)) {

    ExtensionManagementUtility::registerModule(
        'Equed.' . ucfirst($extensionKey),
        'tools', // main module key
        'servicecenter',
        '',
        [
            \Equed\EquedLms\Controller\ServiceCenterController::class => 'index,manageQmsCases,assignExaminers,overview,courseFeedback'
        ],
        [
            'access' => 'admin',
            'icon' => 'EXT:' . $extensionKey . '/Resources/Public/Icons/module-servicecenter.svg',
            'labels' => 'LLL:EXT:' . $extensionKey . '/Resources/Private/Language/locallang_servicecenter.xlf',
        ]
    );

    // Optional: Register module icon
    $iconRegistry->registerIcon(
        'module-servicecenter',
        SvgIconProvider::class,
        ['source' => 'EXT:' . $extensionKey . '/Resources/Public/Icons/module-servicecenter.svg']
    );
}

