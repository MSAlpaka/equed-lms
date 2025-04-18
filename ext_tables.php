<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

// Inhaltselement (optional – wenn z. B. ein Einstiegspunkt im Content benötigt wird)
ExtensionManagementUtility::addPlugin(
    [
        'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tt_content.equed_lms_title',
        'equed_lms',
    ],
    'CType',
    'equed_lms'
);

// Optional: Custom CType Konfiguration (wenn im tt_content benötigt)
$GLOBALS['TCA']['tt_content']['types']['equed_lms'] = [
    'showitem' => '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            header, bodytext,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
            hidden, starttime, endtime
    ',
];

// Backend-Module (für Admin, ServiceCenter, QMS, Zertifikate etc.)
if (TYPO3_MODE === 'BE') {
    // Admin-Modul für Zertifizierungs- und QMS-Verwaltung
    ExtensionUtility::registerModule(
        'Equed.EquedLms',
        'system', // Main area (web/system/user)
        'adminpanel',
        '',
        [
            \Equed\EquedLms\Controller\Admin\CertifierController::class => 'index, validateCertificate, showCase',
            \Equed\EquedLms\Controller\Admin\QmsController::class => 'listCases, reviewCase, closeCase',
        ],
        [
            'access' => 'admin',
            'icon'   => 'EXT:equed_lms/Resources/Public/Icons/Extension.svg',
            'labels' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_adminpanel.xlf',
        ]
    );

    // Instructor-Modul für Prüfungen, Feedback, Bewertungen
    ExtensionUtility::registerModule(
        'Equed.EquedLms',
        'user',
        'instructorpanel',
        '',
        [
            \Equed\EquedLms\Controller\Instructor\DashboardController::class => 'index, showStudent, uploadReport, commentSubmission',
        ],
        [
            'access' => 'user,group',
            'icon'   => 'EXT:equed_lms/Resources/Public/Icons/Instructor.svg',
            'labels' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_instructorpanel.xlf',
        ]
    );

    // ServiceCenter-Modul (Zuweisungen, Sonderfälle, Incidents)
    ExtensionUtility::registerModule(
        'Equed.EquedLms',
        'system',
        'servicecenter',
        '',
        [
            \Equed\EquedLms\Controller\ServiceCenter\ServiceController::class => 'index, assignExaminer, listPending, notifyInstructor',
        ],
        [
            'access' => 'admin',
            'icon'   => 'EXT:equed_lms/Resources/Public/Icons/ServiceCenter.svg',
            'labels' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_servicecenter.xlf',
        ]
    );
}