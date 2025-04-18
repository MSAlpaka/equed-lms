
<?php
defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(function () {
    ExtensionManagementUtility::addTCAcolumns('tx_equedlms_domain_model_contentpage', [
        'title' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:contentpage.title',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,required',
            ],
        ],
        'lesson' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:contentpage.lesson',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_lesson',
                'maxitems' => 1,
            ],
        ],
        'sort_order' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:contentpage.sort_order',
            'config' => [
                'type' => 'number',
                'default' => 100,
            ],
        ],
        'slug_anchor' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:contentpage.slug_anchor',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,uniqueInSite',
            ],
        ],
        'content' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:contentpage.content',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'rows' => 15,
                'cols' => 80,
            ],
        ],
        'media' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:contentpage.media',
            'config' => [
                'type' => 'file',
                'maxitems' => 1,
                'appearance' => [
                    'createNewRelationLinkTitle' => 'LLL:EXT:core/Resources/Private/Language/locallang_core.xlf:cm.addMedia'
                ],
            ],
        ],
        'media_caption' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:contentpage.media_caption',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ],
        ],
        'quote' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:contentpage.quote',
            'config' => [
                'type' => 'text',
                'rows' => 3,
                'cols' => 80,
            ],
        ],
        'downloadable_files' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:contentpage.downloadable_files',
            'config' => [
                'type' => 'file',
                'maxitems' => 10,
                'appearance' => [
                    'createNewRelationLinkTitle' => 'Datei hinzufügen',
                ],
            ],
        ],
        'estimated_reading_time_min' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:contentpage.estimated_reading_time_min',
            'config' => [
                'type' => 'number',
            ],
        ],
        'highlight' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:contentpage.highlight',
            'config' => [
                'type' => 'check',
            ],
        ],
        'navigation_label' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:contentpage.navigation_label',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ],
        ],
        'interactive_type' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:contentpage.interactive_type',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['Lesetext', 'text'],
                    ['Video', 'video'],
                    ['Arbeitsblatt', 'worksheet'],
                    ['Übung', 'exercise'],
                    ['Audio', 'audio'],
                    ['Quiz', 'quiz'],
                ],
                'default' => 'text',
            ],
        ],
        'learning_objectives' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:contentpage.learning_objectives',
            'config' => [
                'type' => 'text',
                'rows' => 4,
                'cols' => 80,
            ],
        ],
        'api_visibility' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:contentpage.api_visibility',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['Alle sichtbar', 'all'],
                    ['Nur eingeloggte User', 'user'],
                    ['Nicht sichtbar', 'none'],
                ],
                'default' => 'user',
            ],
        ],
    ]);

    ExtensionManagementUtility::addToAllTCAtypes(
        'tx_equedlms_domain_model_contentpage',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        title, slug_anchor, lesson, sort_order,
        content, media, media_caption, quote, downloadable_files,
        estimated_reading_time_min, highlight, navigation_label, interactive_type, learning_objectives,
        api_visibility'
    );
})();
