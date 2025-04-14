<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_user',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_user.svg',
    ],
    'types' => [
        '0' => [
            'showitem' => '
                --div--;General,
                    name, email
            ',
        ],
    ],
    'columns' => [
        'name' => [
            'label' => 'Name',
            'config' => [
                'type' => 'input',
                'required' => true,
            ],
        ],
        'email' => [
            'label' => 'Email',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,email',
                'required' => true,
            ],
        ],
    ],
];