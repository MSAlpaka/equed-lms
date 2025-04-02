<?php

defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

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

// 🔽 NEU: VerifyCertificate Plugin
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