<?php
defined('TYPO3_MODE') or die();

return [
    'ctrl' => [
        'title' => 'User',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'default_sortby' => 'ORDER BY name',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'dividers2tabs' => TRUE,
        'searchFields' => 'name,email',
    ],
    'interface' => [
        'showRecordFieldList' => 'name, email, courses',
    ],
    'types' => [
        '1' => ['showitem' => 'name, email, courses'],
    ],
    'columns' => [
        'name' => [
            'exclude' => 0,
            'label' => 'Name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required',
            ]
        ],
        'email' => [
            'exclude' => 0,
            'label' => 'Email',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,email',
                'size' => 30
            ]
        ],
        'courses' => [
            'exclude' => 0,
            'label' => 'Courses',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_equedlms_domain_model_usercourserecord',
                'foreign_field' => 'fe_user',
                'maxitems' => 9999,
                'appearance' => [
                    'collapseAll' => 1,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ],
            ],
        ],
    ],
];