<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use Equed\EquedLms\Controller\Api\LessonApiController;
use Equed\EquedLms\Command\GenerateCertificateCodeCommand;
use Equed\EquedLms\Command\NotifyCertifierCommand;

defined('TYPO3') or die();

// Icon-Registrierung (sofern nicht in Icons.php ausgelagert)
ExtensionManagementUtility::registerIcon(
    'equed-lms-module',
    SvgIconProvider::class,
    ['source' => 'EXT:equed_lms/Resources/Public/Icons/Extension.svg']
);

// Plugin-Registrierung (optional, z. B. wenn du z. B. ein Login-Modul hast)
ExtensionUtility::configurePlugin(
    'Equed.EquedLms',
    'Main',
    [
        \Equed\EquedLms\Controller\Frontend\DashboardController::class => 'index, myCourses, myCertificates',
    ],
    [],
);

// REST-API-Routen (PSR-basiert – Services.yaml notwendig)
$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['lesson_progress'] = LessonApiController::class . '::handleEid';

// Signal-Slot-Verknüpfungen (z. B. nach Kursabschluss)
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['equed_lms']['courseCompleted'][] =
    \Equed\EquedLms\EventHandler\CourseCompletionHandler::class . '::handle';

// CLI-Befehle (z. B. Zertifikats-Code generieren, Benachrichtigung versenden)
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] =
    GenerateCertificateCodeCommand::class;

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] =
    NotifyCertifierCommand::class;

// (Optional) zusätzliche Initialisierung: z. B. für SSO, GPT oder Sondermodule
// Beispiel: Registriere GPT-Auswertung nach Submission
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['equed_lms']['submissionAnalyzed'][] =
    \Equed\EquedLms\Service\GptAnalysisService::class . '::handle';

// PSR-14 EventListener (wenn du PSR statt SignalSlot nutzt, empfohlen!)
$GLOBALS['TYPO3_CONF_VARS']['EVENT_DISPATCHER']['listeners'][\Equed\EquedLms\Event\CourseCompletedEvent::class][] =
    [\Equed\EquedLms\EventHandler\CourseCompletionHandler::class, 'onCourseCompleted'];

$GLOBALS['TYPO3_CONF_VARS']['EVENT_DISPATCHER']['listeners'][\Equed\EquedLms\Event\SubmissionUploadedEvent::class][] =
    [\Equed\EquedLms\Service\GptAnalysisService::class, 'onSubmissionUploaded'];