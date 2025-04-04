<?php
defined('TYPO3_MODE') or die();

return [
    'ctrl' => [
        'title' => 'Lesson',
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
        'showRecordFieldList' => 'title, description, course',
    ],
    'types' => [
        '1' => ['showitem' => 'title, description, course'],
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
        'course' => [
            'exclude' => 0,
            'label' => 'Course',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_equedlms_domain_model_course',
                'minitems' => 0,
                'maxitems' => 1,
            ]
        ],
    ],
];