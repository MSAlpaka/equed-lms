<?php

return [
    'ctrl' => [
        'title' => 'Center',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'hideTable' => false,
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_center.svg',
    ],
    'types' => [
        '0' => ['showitem' => '
            --div--;General,
                name, street, zip, city, country, region, website, centerId, logo, status, latitude, longitude
        '],
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
        'region' => [
            'label' => 'Region',
            'config' => [
                'type' => 'input',
            ],
        ],
        'website' => [
            'label' => 'Website',
            'config' => [
                'type' => 'input',
            ],
        ],
        'centerId' => [
            'label' => 'Center ID',
            'config' => [
                'type' => 'input',
            ],
        ],
        'logo' => [
            'label' => 'Logo',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'sys_file',
                'foreign_field' => 'uid',
                'maxitems' => 1,
                'appearance' => [
                    'useSortable' => true,
                    'showPossible' => true,
                    'showAll' => true,
                ],
            ],
        ],
        'status' => [
            'label' => 'Status',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['Active', 'active'],
                    ['Suspended', 'suspended'],
                    ['Under Review', 'under_review'],
                ],
            ],
        ],
        'latitude' => [
            'label' => 'Latitude',
            'config' => [
                'type' => 'input',
                'eval' => 'double2',
            ],
        ],
        'longitude' => [
            'label' => 'Longitude',
            'config' => [
                'type' => 'input',
                'eval' => 'double2',
            ],
        ],
    ],
];
