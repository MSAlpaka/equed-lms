<?php

defined('TYPO3_MODE') or die();

call_user_func(
    function () {
        // TCA für 'Lesson' hinzufügen
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
            'tx_equedlms_domain_model_lesson',
            [
                'title' => [
                    'label' => 'Title',
                    'config' => [
                        'type' => 'input',
                        'required' => true,
                        'eval' => 'trim',
                    ],
                ],
                'slug' => [
                    'label' => 'Slug',
                    'config' => [
                        'type' => 'input',
                        'eval' => 'trim',
                    ],
                ],
                'position' => [
                    'label' => 'Position',
                    'config' => [
                        'type' => 'number',
                    ],
                ],
                'course' => [
                    'label' => 'Course',
                    'config' => [
                        'type' => 'group',
                        'internal_type' => 'db',
                        'allowed' => 'tx_equedlms_domain_model_course',
                        'size' => 1,
                        'minitems' => 0,
                        'maxitems' => 1,
                    ],
                ],
                'materials' => [
                    'label' => 'Materials',
                    'config' => [
                        'type' => 'file',
                        'appearance' => [
                            'createNewRelationLinkTitle' => 'Add Material'
                        ],
                        'maxitems' => 10,
                        'uploadFolder' => '1:/user_upload/materials/',
                    ],
                ],
            ]
        );

        // TCA für 'Lesson' Typen hinzufügen
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
            'tx_equedlms_domain_model_lesson',
            'title, slug, position, course, materials',
            '',
            'after:title'
        );
    }
);