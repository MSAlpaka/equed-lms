<?php

defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

$extensionKey = 'equed_lms';

//
// -------------------------------------------------------------
// 1. Plugin-Registrierung (für Extbase-basierte Komponenten)
// -------------------------------------------------------------
// Wird verwendet für z. B. Backend-Dashboards oder Extbase-basierte Ajax-Actions
//
ExtensionUtility::configurePlugin(
    'Equed.EquedLms',
    'Dashboard',
    [
        \Equed\EquedLms\Controller\DashboardController::class => 'index,statistics,feedback,certification'
    ],
    []
);

//
// -------------------------------------------------------------
// 2. Event-Listener (Zertifikate, QMS, Benachrichtigung, Instructor-Flows)
// -------------------------------------------------------------
// Sämtliche Event-getriebene Prozesse
//
$GLOBALS['TYPO3_CONF_VARS']['SYS']['eventListeners'] += [
    \Equed\EquedLms\Event\CourseCompletedEvent::class => [
        \Equed\EquedLms\EventListener\CertificateGenerationListener::class
    ],
    \Equed\EquedLms\Event\QmsCaseOpenedEvent::class => [
        \Equed\EquedLms\EventListener\QmsNotificationListener::class
    ],
    \Equed\EquedLms\Event\SubmissionUploadedEvent::class => [
        \Equed\EquedLms\EventListener\InstructorNotificationListener::class
    ],
];

//
// -------------------------------------------------------------
// 3. Caching-Strategien für API, Fortschritt, Kursstruktur
// -------------------------------------------------------------
// Bereitet schnelle API-Antworten & SPA-Datenlieferung vor
//
$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations'] += [
    'equed_lms_cache' => [
        'frontend' => \TYPO3\CMS\Core\Cache\Frontend\VariableFrontend::class,
        'backend' => \TYPO3\CMS\Core\Cache\Backend\Typo3DatabaseBackend::class,
        'groups' => ['system']
    ],
    'equed_lms_coursestructure' => [
        'frontend' => \TYPO3\CMS\Core\Cache\Frontend\VariableFrontend::class,
        'backend' => \TYPO3\CMS\Core\Cache\Backend\Typo3DatabaseBackend::class,
        'groups' => ['pages', 'system']
    ]
];

//
// -------------------------------------------------------------
// 4. REST-API / eID-Controller-Registrierung (z. B. für App, SPA, SSO)
// -------------------------------------------------------------
// eID-Aufrufe ohne Session für Fortschritt, Zertifikate etc.
//
$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include'] += [
    'lessonProgress' => \Equed\EquedLms\Controller\Api\LessonProgressController::class . '::handleRequest',
    'instructorDashboard' => \Equed\EquedLms\Controller\Api\InstructorDashboardController::class . '::handleRequest',
    'certificateDownload' => \Equed\EquedLms\Controller\Api\CertificateController::class . '::handleDownload'
];

//
// -------------------------------------------------------------
// 5. Scheduler-Tasks (z. B. automatische Erinnerungen für Re-Zertifizierung)
// -------------------------------------------------------------
// Aufgaben, die zeitgesteuert im Hintergrund laufen
//
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][\Equed\EquedLms\Task\CertificateRenewalReminderTask::class] = [
    'extension' => $extensionKey,
    'title' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang.xlf:scheduler.certRenewal.title',
    'description' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang.xlf:scheduler.certRenewal.description'
];

//
// -------------------------------------------------------------
// 6. (Optional) Middleware für API-Authentication / DSGVO / SSO
// -------------------------------------------------------------
// Vorbereitet für spätere SSO-Implementierung (z. B. FE-User Sync)
//
/*
$GLOBALS['TYPO3_CONF_VARS']['FE']['middleware']['equed/authentication'] = [
    'target' => \Equed\EquedLms\Middleware\ApiAuthenticationMiddleware::class,
    'after' => ['typo3/cms-frontend/authentication']
];
*/

