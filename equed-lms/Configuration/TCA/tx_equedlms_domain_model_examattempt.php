<?php

return [
    'ctrl' => [
        'title' => 'Exam Attempt',
        'label' => 'type',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'sortby' => 'crdate',
        'delete' => 'deleted',
        'hideTable' => false,
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/examattempt.svg',
    ],
    'interface' => [
        'showRecordFieldList' => 'record,type,passed,feedback,attempt_date,instructor',
    ],
    'types' => [
        '1' => ['showitem' => 'record, type, passed, feedback, attempt_date, instructor'],
    ],
    'columns' => [
        'record' => [
            'label' => 'Kursversuch (UserCourseRecord)',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_equedlms_domain_model_usercourserecord',
                'renderType' => 'selectSingle',
            ],
        ],
        'type' => [
            'label' => 'Prüfungstyp',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['Theorieprüfung', 'theory'],
                    ['Praxisprüfung', 'practical'],
                    ['Fallbericht', 'case'],
                ],
                'required' => true,
            ],
        ],
        'passed' => [
            'label' => 'Bestanden?',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'feedback' => [
            'label' => 'Feedback',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
            ],
        ],
        'attempt_date' => [
            'label' => 'Versuchsdatum',
            'config' => [
                'type' => 'datetime',
                'required' => true,
            ],
        ],
        'instructor' => [
            'label' => 'Prüfende Person',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'fe_users',
                'renderType' => 'selectSingle',
            ],
        ],
    ],
];