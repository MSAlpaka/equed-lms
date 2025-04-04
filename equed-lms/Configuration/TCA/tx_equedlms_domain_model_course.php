<?php
defined('TYPO3_MODE') or die();

return [
    'ctrl' => [
        'title' => 'Course',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'default_sortby' => 'ORDER BY title',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'dividers2tabs' => TRUE,
        'searchFields' => 'title,description',
    ],
    'interface' => [
        'showRecordFieldList' => 'title, description, lessons',
    ],
    'types' => [
        '1' => ['showitem' => 'title, description, lessons'],
    ],
    'columns' => [
        'title' => [
            'exclude' => 0,
            'label' => 'Title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required',
            ]
        ],
        'description' => [
            'exclude' => 0,
            'label' => 'Description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
            ]
        ],
        'lessons' => [
            'exclude' => 0,
            'label' => 'Lessons',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_equedlms_domain_model_lesson',
                'foreign_field' => 'course',
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