<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'EquEd LMS',
    'description' => 'Modulare Lernplattform für digitale Hufbearbeitung und verwandte Qualifikationen – inklusive Prüfungslogik, Zertifizierungen, Instructor-Dashboards und QMS.',
    'category' => 'plugin',
    'author' => 'EquEd Development Team',
    'author_email' => 'dev@equed.eu',
    'author_company' => 'EquEdEU / Equine Education Europe Ltd.',
    'state' => 'stable',
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '13.4.0-13.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
    'autoload' => [
        'psr-4' => [
            'Equed\\EquedLms\\' => 'Classes/',
        ],
    ],
    'composer' => true
];