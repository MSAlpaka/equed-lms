<?php

defined('TYPO3_MODE') or die();

call_user_func(
    function () {
        // TCA für 'Course' hinzufügen
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
            'tx_equedlms_domain_model_course',
            [
                'title' => [
                    'exclude' => true,
                    'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_course.title',
                    'config' => [
                        'type' => 'input',
                        'size' => 30,
                        'max' => 255,
                        'eval' => 'trim',
                    ],
                ],
                'description' => [
                    'exclude' => true,
                    'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_course.description',
                    'config' => [
                        'type' => 'text',
                        'cols' => '30',
                        'rows' => '5',
                    ],
                ],
                'category' => [
                    'exclude' => true,
                    'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_course.category',
                    'config' => [
                        'type' => 'input',
                        'size' => 30,
                        'max' => 255,
                        'eval' => 'trim',
                    ],
                ],
                'isActive' => [
                    'exclude' => true,
                    'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_course.isActive',
                    'config' => [
                        'type' => 'check',
                    ],
                ],

                // **finish_goal**: Das Feld für das Abschlussziel des Kurses (z. B. "HoofCare Specialist")
                'finish_goal' => [
                    'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_course.finish_goal',
                    'config' => [
                        'type' => 'select',
                        'items' => [
                            ['HoofCare Specialist', 'hoofcare_specialist'],
                            ['Specialty Instructor HoofCare for Donkeys', 'specialty_instructor_hoofcare_for_donkeys'],
                            ['Specialty Instructor HoofCare for Foals', 'specialty_instructor_hoofcare_for_foals'],
                            // Weitere Ziele hinzufügen
                        ],
                        'default' => 'hoofcare_specialist',  // Standardwert
                    ],
                ],

                // **prerequisites**: Das Feld für die Zugangsvoraussetzungen basierend auf den Abschlusszielen anderer Kurse
                'prerequisites' => [
                    'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_course.prerequisites',
                    'config' => [
                        'type' => 'inline',
                        'foreign_table' => 'tx_equedlms_domain_model_course',
                        'maxitems' => 10,
                        'minitems' => 0,
                    ],
                ],
            ]
        );

        // TCA für 'Course' mit den neuen Feldern hinzufügen
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
            'tx_equedlms_domain_model_course',
            'title, description, category, isActive, finish_goal, prerequisites', // Die Felder, die hinzugefügt werden
            '',
            'after:title' // Position der neuen Felder im Backend
        );
    }
);