<?php

defined('TYPO3') or die();

return [
    'columns' => [
        'is_certifier' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:fe_users.is_certifier',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => '--palette--;;general, --palette--;;headers, is_certifier, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access']
    ],
];