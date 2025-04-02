<?php

return [
    'ctrl' => [
        'title' => 'Center',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/center.svg',
    ],
    'columns' => [
        'name' => [
            'label' => 'Name',
            'config' => [
                'type' => 'input',
                'required' => true,
            ],
        ],
        'street' => [
            'label' => 'Street',
            'config' => [
                'type' => 'input',
            ],
        ],
        'zip' => [
            'label' => 'ZIP',
            'config' => [
                'type' => 'input',
            ],
        ],
        'city' => [
            'label' => 'City',
            'config' => [
                'type' => 'input',
            ],
        ],
        'country' => [
            'label' => 'Country',
            'config' => [
                'type' => 'input',
            ],
        ],
        'phone' => [
            'label' => 'Phone',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
            ],
        ],
        'website' => [
            'label' => 'Website',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
                'renderType' => 'inputLink',
            ],
        ],
        'center_id' => [
            'label' => 'Center ID',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,alphanum',
            ],
        ],
        'logo' => [
            'label' => 'Logo',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'sys_file_reference',
                'foreign_field' => 'uid_foreign',
                'foreign_sortby' => 'sorting_foreign',
                'foreign_table_field' => 'tablenames',
                'foreign_match_fields' => [
                    'fieldname' => 'logo',
                ],
                'appearance' => [
                    'createNewRelationLinkTitle' => 'Add Logo',
                    'showPossibleLocalizationRecords' => true,
                    'showRemovedLocalizationRecords' => false,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
        'certifier' => [
            'label' => 'Responsible Certifier',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'foreign_table' => 'fe_users',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
    ],
    'types' => [
        '0' => ['showitem' =>
            'name, street, zip, city, country, phone, website, center_id, logo, certifier'],
    ],
];