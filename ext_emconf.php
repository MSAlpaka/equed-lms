<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'EquEd LMS',
    'description' => 'Learning Management System for Equine Education Europe – including courses, lessons, certification, instructor workflows, QMS, and full SPA/App compatibility.',
    'category' => 'plugin',
    'author' => 'Equine Education Europe',
    'author_email' => 'dev@equed.eu',
    'state' => 'stable',
    'clearCacheOnLoad' => true,
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '13.4.0-13.9.99',
            'extbase' => '',
            'fluid' => '',
            'scheduler' => '',
            'filemetadata' => ''
        ],
        'conflicts' => [],
        'suggests' => []
    ],
    'autoload' => [
        'psr-4' => [
            'Equed\\EquedLms\\' => 'Classes/'
        ]
    ],
    'autoload-dev' => [
        'psr-4' => [
            'Equed\\EquedLms\\Tests\\' => 'Tests/'
        ]
    ],
    'uploadfolder' => 1,
    'createDirs' => 'uploads/tx_equedlms/submissions/,uploads/tx_equedlms/materials/',
    'modify_tables' => 'fe_users',
    'additionalFields' => 'README.md,LICENSE.md',
    'icon' => 'EXT:equed_lms/Resources/Public/Icons/Extension.svg'
];

