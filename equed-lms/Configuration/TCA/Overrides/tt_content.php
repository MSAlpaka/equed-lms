<?php

defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

// Plugin-Registrierungen mit Icon-Zuweisung
ExtensionManagementUtility::addPlugin(
    ['Course Plugin', 'equedlms_course', 'EXT:equed_lms/Resources/Public/Icons/PluginCourse.svg'],
    'CType',
    'equed_lms'
);

ExtensionManagementUtility::addPlugin(
    ['Lesson Plugin', 'equedlms_lesson', 'EXT:equed_lms/Resources/Public/Icons/PluginLesson.svg'],
    'CType',
    'equed_lms'
);

ExtensionManagementUtility::addPlugin(
    ['Submission Plugin', 'equedlms_submission', 'EXT:equed_lms/Resources/Public/Icons/PluginSubmission.svg'],
    'CType',
    'equed_lms'
);

ExtensionManagementUtility::addPlugin(
    ['Certifier Plugin', 'equedlms_certifier', 'EXT:equed_lms/Resources/Public/Icons/PluginCertifier.svg'],
    'CType',
    'equed_lms'
);

ExtensionManagementUtility::addPlugin(
    ['Certificate Plugin', 'equedlms_certificate', 'EXT:equed_lms/Resources/Public/Icons/PluginCertificate.svg'],
    'CType',
    'equed_lms'
);

ExtensionManagementUtility::addPlugin(
    ['UserSubmission Plugin', 'equedlms_usersubmission', 'EXT:equed_lms/Resources/Public/Icons/PluginUserSubmission.svg'],
    'CType',
    'equed_lms'
);

ExtensionManagementUtility::addPlugin(
    ['UserCourseRecord Plugin', 'equedlms_usercourserecord', 'EXT:equed_lms/Resources/Public/Icons/PluginUserCourseRecord.svg'],
    'CType',
    'equed_lms'
);

ExtensionManagementUtility::addPlugin(
    ['SSO Login Plugin', 'equedlms_ssologin', 'EXT:equed_lms/Resources/Public/Icons/PluginSsoLogin.svg'],
    'CType',
    'equed_lms'
);

// Bestehendes TCA beibehalten und zurückgeben
return [
    'types' => [
        'certification_card' => [
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
        ],
        'equed_instructor_onboarding' => [
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
        ],
    ],
];