<?php
defined('TYPO3_MODE') or die();

call_user_func(function () {

    // Modul für die Kursverwaltung
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'Equed.' . $_EXTKEY,  // Modulkey
        'tools',  // Übergeordnetes Modul
        'courseManagement',  // Modulname
        '',  // Position
        [
            'Course' => 'index, list, new, create, edit, update, delete',
            'Lesson' => 'index, list, new, create, edit, update, delete',
        ],  // Controller und Aktionen
        [
            'access' => 'user,group',  // Zugriffskontrolle
            'icon' => 'EXT:equed_lms/Resources/Public/Icons/course_module.svg',
            'labels' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_course.xlf',
        ]
    );

    // Modul für die Zertifikatsverwaltung
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'Equed.' . $_EXTKEY, 
        'tools',  
        'certificateManagement',  
        '',  
        [
            'Certificate' => 'index, list, generate, send, validate',
        ],  
        [
            'access' => 'user,group',  
            'icon' => 'EXT:equed_lms/Resources/Public/Icons/certificate_module.svg',
            'labels' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_certificate.xlf',
        ]
    );

    // Modul für die Benutzerverwaltung
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'Equed.' . $_EXTKEY, 
        'tools',  
        'userManagement',  
        '',  
        [
            'User' => 'index, list, create, update, delete',
        ],  
        [
            'access' => 'user,group',  
            'icon' => 'EXT:equed_lms/Resources/Public/Icons/user_module.svg',
            'labels' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_user.xlf',
        ]
    );

    // Modul für das Qualitätsmanagement
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'Equed.' . $_EXTKEY, 
        'tools',  
        'qmsManagement',  
        '',  
        [
            'QmsCase' => 'index, list, create, update, resolve',
        ],  
        [
            'access' => 'user,group',  
            'icon' => 'EXT:equed_lms/Resources/Public/Icons/qms_module.svg',
            'labels' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_qms.xlf',
        ]
    );

    // Modul für das Instructor Dashboard
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'Equed.' . $_EXTKEY, 
        'tools',  
        'instructorDashboard',  
        '',  
        [
            'Instructor' => 'index, list, new, create, edit, update',
            'User' => 'list, details, updateProgress',
        ],  
        [
            'access' => 'user,group',  
            'icon' => 'EXT:equed_lms/Resources/Public/Icons/instructor_module.svg',
            'labels' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_instructor.xlf',
        ]
    );

    // Modul für das Frontend-Dashboard
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'Equed.' . $_EXTKEY, 
        'tools',  
        'frontendDashboard',  
        '',  
        [
            'Frontend' => 'index, list, progress',
        ],  
        [
            'access' => 'user,group',  
            'icon' => 'EXT:equed_lms/Resources/Public/Icons/frontend_dashboard.svg',
            'labels' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_frontend.xlf',
        ]
    );

});