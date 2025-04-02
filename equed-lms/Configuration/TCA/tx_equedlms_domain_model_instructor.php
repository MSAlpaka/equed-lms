<?php

defined('TYPO3_MODE') or die();

call_user_func(
    function () {
        // TCA für 'Instructor' hinzufügen
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
            'tx_equedlms_domain_model_instructor',
            [
                'regionPostalCodes' => [
                    'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_instructor.regionPostalCodes',
                    'config' => [
                        'type' => 'input',
                        'size' => 30,
                        'max' => 255,
                        'eval' => 'trim',
                    ],
                ],
            ]
        );

        // TCA für 'Instructor' mit neuem Feld
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
            'tx_equedlms_domain_model_instructor',
            'regionPostalCodes',
            '',
            'after:title' // Position des Feldes im Backend
        );
    }
);