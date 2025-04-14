<?php

defined('TYPO3') or die();

use function str_contains;

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use Equed\EquedLms\Controller\CourseController;
use Equed\EquedLms\Controller\LessonController;
use Equed\EquedLms\Controller\SubmissionController;
use Equed\EquedLms\Controller\CertifierController;
use Equed\EquedLms\Controller\CertificateController;
use Equed\EquedLms\Controller\UserSubmissionController;
use Equed\EquedLms\Controller\UserCourseRecordController;
use Equed\EquedLms\Controller\SsoLoginController;

// Kontext-Ermittlung anhand der Domain / Determine context based on domain
$host = $_SERVER['HTTP_HOST'] ?? 'unknown';
$isTraining = str_contains($host, 'training.equed.eu');

// Volles LMS NUR in training.equed.eu aktivieren
// Activate full LMS features only on training.equed.eu
if ($isTraining) {
    ExtensionUtility::configurePlugin(
        'Equed.EquedLms',
        'Course',
        [CourseController::class => 'list, show'],
        [],
        ['noCache' => true]
    );

    ExtensionUtility::configurePlugin(
        'Equed.EquedLms',
        'Lesson',
        [LessonController::class => 'show'],
        [],
        ['noCache' => true]
    );

    ExtensionUtility::configurePlugin(
        'Equed.EquedLms',
        'Submission',
        [SubmissionController::class => 'new, create'],
        [],
        ['noCache' => true]
    );

    ExtensionUtility::configurePlugin(
        'Equed.EquedLms',
        'Certifier',
        [CertifierController::class => 'list, approve'],
        [],
        ['noCache' => true]
    );

    ExtensionUtility::configurePlugin(
        'Equed.EquedLms',
        'Certificate',
        [CertificateController::class => 'view, download'],
        [],
        ['noCache' => true]
    );

    ExtensionUtility::configurePlugin(
        'Equed.EquedLms',
        'UserSubmission',
        [UserSubmissionController::class => 'index, view'],
        [],
        ['noCache' => true]
    );

    ExtensionUtility::configurePlugin(
        'Equed.EquedLms',
        'UserCourseRecord',
        [UserCourseRecordController::class => 'list, show'],
        [],
        ['noCache' => true]
    );

    ExtensionUtility::configurePlugin(
        'Equed.EquedLms',
        'SsoLogin',
        [SsoLoginController::class => 'login, logout'],
        [],
        ['noCache' => true]
    );

    // Plugin für Instructor-Dashboard
    ExtensionUtility::configurePlugin(
        'Equed.EquedLms',
        'InstructorDashboard',
        [\\Equed\\EquedLms\\Controller\\InstructorDashboardController::class => 'index, showParticipants, confirmCompletion'],
        [],
        ['noCache' => true]
    );
}