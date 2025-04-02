<?php

return [
    'ctrl' => [
        'title' => 'Badge',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/badge.svg',
    ],
    'columns' => [
        'name' => [
            'label' => 'Name',
            'config' => [
                'type' => 'input',
                'required' => true,
            ],
        ],
        'description' => [
            'label' => 'Description',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
            ],
        ],
        'identifier' => [
            'label' => 'Identifier (Slug)',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,alphanum_x,unique',
            ],
        ],
        'icon' => [
            'label' => 'Icon',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'sys_file_reference',
                'foreign_field' => 'uid_foreign',
                'foreign_sortby' => 'sorting_foreign',
                'foreign_table_field' => 'tablenames',
                'foreign_match_fields' => [
                    'fieldname' => 'icon',
                ],
                'appearance' => [
                    'createNewRelationLinkTitle' => 'Add Icon',
                    'showPossibleLocalizationRecords' => true,
                    'showRemovedLocalizationRecords' => false,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
    ],
    'types' => [
        '0' => ['showitem' => 'name, identifier, description, icon'],
    ],
];