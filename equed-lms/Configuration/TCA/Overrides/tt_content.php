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

// ALT: Plugin-Registrierung via list_type – bitte auf CType umstellen

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

// Weitere CType-Definitionen können hier folgen