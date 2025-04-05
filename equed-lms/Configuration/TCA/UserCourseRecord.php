<?php

return [
    'ctrl' => [
        'title' => 'User Course Record',
        'label' => 'uid',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'user,courseInstance',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/usercourserecord.svg',
    ],
    'types' => [
        '0' => ['showitem' => 'user, course_instance, completion_date, certificate_code, slug'],
    ],
    'columns' => [
        'slug' => [
            'exclude' => true,
            'label' => 'Slug',
            'config' => [
                'type' => 'slug',
                'generatorOptions' => [
                    'fields' => ['user', 'course_instance'],
                ],
                'fallbackCharacter' => '-',
                'eval' => 'uniqueInSite',
                'default' => '',
            ],
        ],
        'user' => [
            'exclude' => true,
            'label' => 'User',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'size' => 1,
                'minitems' => 1,
                'maxitems' => 1,
            ],
        ],
        'course_instance' => [
            'exclude' => true,
            'label' => 'Course Instance',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_equedlms_domain_model_courseinstance',
                'size' => 1,
                'minitems' => 1,
                'maxitems' => 1,
            ],
        ],
        'completion_date' => [
            'exclude' => true,
            'label' => 'Completion Date',
            'config' => [
                'type' => 'datetime',
                'required' => false,
            ],
        ],
        'certificate_code' => [
            'exclude' => true,
            'label' => 'Certificate Code',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,unique',
                'size' => 30,
            ],
        ],
    ],
];
