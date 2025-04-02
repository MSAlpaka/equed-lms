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
                'startDate' => [
                    'exclude' => true,
                    'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_course.startDate',
                    'config' => [
                        'type' => 'datetime',
                    ],
                ],
                'endDate' => [
                    'exclude' => true,
                    'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_course.endDate',
                    'config' => [
                        'type' => 'datetime',
                    ],
                ],
            ],
            1
        );

        // TCA für 'Course' Typen hinzufügen
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
            'tx_equedlms_domain_model_course',
            'title, description, category, isActive, startDate, endDate',
            '',
            'after:description'
        );
    }
);