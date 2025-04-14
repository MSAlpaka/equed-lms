<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_center',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_center.svg',
    ],
    'types' => [
        '0' => [
            'showitem' => '
                --div--;General,
                    name, center_id, status,
                --div--;Location,
                    street, zip, city, country, region, latitude, longitude,
                --div--;Web & Media,
                    website, logo
            ',
        ],
    ],
    'columns' => [
        'name' => [
            'label' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_center.name',
            'config' => [
                'type' => 'input',
                'required' => true,
            ],
        ],
        'center_id' => [
            'label' => 'Center ID',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
                'placeholder' => 'ABC123',
                'size' => 20,
            ],
        ],
        'status' => [
            'label' => 'Status',
            'config' => [
                'type' => 'input',
            ],
        ],
        'street' => [
            'label' => 'Street',
            'config' => ['type' => 'input'],
        ],
        'zip' => [
            'label' => 'ZIP',
            'config' => ['type' => 'input'],
        ],
        'city' => [
            'label' => 'City',
            'config' => ['type' => 'input'],
        ],
        'country' => [
            'label' => 'Country',
            'config' => ['type' => 'input'],
        ],
        'region' => [
            'label' => 'Region',
            'config' => ['type' => 'input'],
        ],
        'latitude' => [
            'label' => 'Latitude',
            'config' => [
                'type' => 'number',
                'format' => 'float',
            ],
        ],
        'longitude' => [
            'label' => 'Longitude',
            'config' => [
                'type' => 'number',
                'format' => 'float',
            ],
        ],
        'website' => [
            'label' => 'Website',
            'config' => ['type' => 'input', 'eval' => 'trim'],
        ],
        'logo' => [
            'label' => 'Logo',
            'config' => [
                'type' => 'file',
                'appearance' => [
                    'createNewRelationLinkTitle' => 'Add File',
                ],
                'allowed' => ['jpg', 'jpeg', 'png', 'svg'],
                'maxitems' => 1,
            ],
        ],
    ],
];