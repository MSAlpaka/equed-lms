<?php

defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

// ✅ Bestehende CType: Certification Card
$GLOBALS['TCA']['tt_content']['types']['certification_card'] = [
    'showitem' => '
        --palette--;;general,
        header,
        --palette--;;headers,
        bodytext,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        pi_flexform,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
        hidden,starttime,endtime
    ',
];
ExtensionManagementUtility::addPlugin(
    [
        'Certification Card',
        'certification_card',
        'EXT:equed_lms/Resources/Public/Icons/certificate.svg',
    ],
    'CType'
);

// ✅ Bestehende CType: Certificate Verification
$GLOBALS['TCA']['tt_content']['types']['verify_certificate'] = [
    'showitem' => '
        --palette--;;general,
        header,
        --palette--;;headers,
        bodytext,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        pi_flexform,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
        hidden,starttime,endtime
    ',
];
ExtensionManagementUtility::addPlugin(
    [
        'Certificate Verification',
        'verify_certificate',
        'EXT:equed_lms/Resources/Public/Icons/certificate.svg',
    ],
    'CType'
);

// 🧹 ALT Entfernt: Instructor Onboarding als list_type ❌
// ExtensionManagementUtility::addPlugin([...], 'list_type', ...);

// ✅ NEU als CType: Instructor Onboarding
$GLOBALS['TCA']['tt_content']['types']['equed_instructor_onboarding'] = [
    'showitem' => '
        --palette--;;general,
        header,
        --palette--;;headers,
        bodytext,
        --div--;General,
        pi_flexform,
        --div--;Access,
        hidden,starttime,endtime
    ',
];
ExtensionManagementUtility::addPlugin(
    [
        'Instructor Onboarding',
        'equed_instructor_onboarding',
        'EXT:equed_lms/Resources/Public/Icons/onboarding.svg'
    ],
    'CType'
);

// ✅ NEUE CType-Elemente (Kurs- und LMS-Module)
$customCtypes = [
    ['Course List', 'equed_course_list', 'course.svg'],
    ['Lesson Show', 'equed_lesson_show', 'lesson.svg'],
    ['Submission Form', 'equed_submission_form', 'submission.svg'],
    ['User Submission Review', 'equed_usersubmission_review', 'review.svg'],
    ['User Course Record', 'equed_usercourserecord_summary', 'record.svg'],
    ['Certificate Display', 'equed_certificate_display', 'certificate.svg'],
    ['Certifier Dashboard', 'equed_certifier_dashboard', 'certifier.svg'],
    ['SSO Login', 'equed_sso_login', 'login.svg'],
];

foreach ($customCtypes as [$title, $identifier, $icon]) {
    $GLOBALS['TCA']['tt_content']['types'][$identifier] = [
        'showitem' => '
            --palette--;;general,
            header,
            --palette--;;headers,
            bodytext,
            --div--;General,
            pi_flexform,
            --div--;Access,
            hidden,starttime,endtime
        ',
    ];

    ExtensionManagementUtility::addPlugin(
        [$title, $identifier, 'EXT:equed_lms/Resources/Public/Icons/' . $icon],
        'CType'
    );
}