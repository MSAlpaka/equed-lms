<?php
// ext_emconf patched manually for Composer

$EM_CONF[$_EXTKEY] = [
    'title' => 'EquEd LMS',
    'description' => 'Learning Management System for Equine Education Europe',
    'category' => 'plugin',
    'author' => 'Matthew Scharf',
    'author_company' => 'Equine Education Europe',
    'author_email' => 'info@equed.eu',
    'state' => 'stable',
    'clearcacheonload' => true,
    'version' => '1.0.1',
    'constraints' => [
        'depends' => [
            'typo3' => '13.0.0-13.9.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];