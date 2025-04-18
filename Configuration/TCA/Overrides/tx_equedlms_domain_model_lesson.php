
<?php
defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(function () {
    ExtensionManagementUtility::addTCAcolumns('tx_equedlms_domain_model_lesson', [
        'title' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:lesson.title',
            'config' => [
                'type' => 'input',
                'required' => true,
                'eval' => 'trim',
            ],
        ],
        'slug' => [
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.slug',
            'config' => [
                'type' => 'slug',
                'generatorOptions' => [
                    'fields' => ['title'],
                ],
                'fallbackCharacter' => '-',
                'prefixParentPageSlug' => false,
            ],
        ],
        'course_program' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:lesson.course_program',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_courseprogram',
                'maxitems' => 1,
            ],
        ],
        'sort_order' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:lesson.sort_order',
            'config' => [
                'type' => 'number',
                'default' => 100,
            ],
        ],
        'content_pages' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:lesson.content_pages',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_equedlms_domain_model_contentpage',
                'foreign_field' => 'lesson',
                'maxitems' => 50,
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                ],
            ],
        ],
        'materials' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:lesson.materials',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_equedlms_domain_model_coursematerial',
                'foreign_field' => 'lesson',
                'maxitems' => 20,
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                ],
            ],
        ],
        'quiz' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:lesson.quiz',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_lessonquiz',
                'maxitems' => 1,
            ],
        ],
        'upload_required' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:lesson.upload_required',
            'config' => [
                'type' => 'check',
            ],
        ],
        'upload_hint' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:lesson.upload_hint',
            'config' => [
                'type' => 'text',
                'rows' => 3,
                'cols' => 60,
            ],
        ],
        'is_mandatory' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:lesson.is_mandatory',
            'config' => [
                'type' => 'check',
            ],
        ],
        'release_after_lesson' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:lesson.release_after_lesson',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_lesson',
                'maxitems' => 1,
            ],
        ],
        'release_after_days' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:lesson.release_after_days',
            'config' => [
                'type' => 'number',
                'default' => 0,
            ],
        ],
        'release_condition_description' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:lesson.release_condition_description',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ],
        ],
        'visible_in_overview' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:lesson.visible_in_overview',
            'config' => [
                'type' => 'check',
                'default' => 1,
            ],
        ],
        'progress_weight' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:lesson.progress_weight',
            'config' => [
                'type' => 'number',
                'default' => 10,
            ],
        ],
        'has_progress_tracking' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:lesson.has_progress_tracking',
            'config' => [
                'type' => 'check',
                'default' => 1,
            ],
        ],
        'requires_quiz_pass' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:lesson.requires_quiz_pass',
            'config' => [
                'type' => 'check',
            ],
        ],
        'estimated_duration_min' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:lesson.estimated_duration_min',
            'config' => [
                'type' => 'number',
            ],
        ],
        'recommended_tools' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:lesson.recommended_tools',
            'config' => [
                'type' => 'text',
                'rows' => 3,
                'cols' => 60,
            ],
        ],
        'lesson_icon' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:lesson.lesson_icon',
            'config' => [
                'type' => 'file',
                'maxitems' => 1,
            ],
        ],
        'learning_objectives' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:lesson.learning_objectives',
            'config' => [
                'type' => 'text',
                'rows' => 5,
                'cols' => 80,
            ],
        ],
        'api_visibility' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:lesson.api_visibility',
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
        'tx_equedlms_domain_model_lesson',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        title, slug, course_program, sort_order, visible_in_overview,
        content_pages, materials, quiz, upload_required, upload_hint,
        is_mandatory, release_after_lesson, release_after_days, release_condition_description,
        has_progress_tracking, progress_weight, requires_quiz_pass,
        estimated_duration_min, recommended_tools, lesson_icon, learning_objectives, api_visibility'
    );
})();
