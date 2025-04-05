<?php

defined('TYPO3') or die();

// Rückgabe-Array statt direkter Manipulation
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