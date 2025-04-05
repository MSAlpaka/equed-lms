<?php

return [
    'ctrl' => [
        'title' => 'User Submission',
        'label' => 'user',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/usersubmission.svg',
    ],
    'columns' => [
        'user' => [
            'label' => 'User',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'foreign_table' => 'fe_users',
                'minitems' => 1,
                'maxitems' => 1,
            ],
        ],
        'course' => [
            'label' => 'Course',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_equedlms_domain_model_course',
                'minitems' => 1,
                'maxitems' => 1,
            ],
        ],
        'file' => [
            'label' => 'File Upload',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'sys_file_reference',
                'foreign_field' => 'uid_foreign',
                'foreign_sortby' => 'sorting_foreign',
                'foreign_table_field' => 'tablenames',
                'foreign_match_fields' => [
                    'fieldname' => 'file',
                ],
                'appearance' => [
                    'createNewRelationLinkTitle' => 'Add File',
                ],
            ],
        ],
        'comment' => [
            'label' => 'Instructor Comment',
            'config' => [
                'type' => 'text',
                'enableRichtext' => false,
            ],
        ],
        'status' => [
            'label' => 'Status',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['Submitted', 'submitted'],
                    ['Reviewed', 'reviewed'],
                    ['Approved', 'approved'],
                    ['Rejected', 'rejected'],
                ],
                'default' => 'submitted',
            ],
        ],
        'submitted_at' => [
            'label' => 'Submission Date',
            'config' => [
                'type' => 'input',
                'type' => 'datetime',
                'eval' => 'datetime',
                'default' => null,
            ],
        ],
    ],
    'types' => [
        '0' => ['showitem' => 'user, course, file, status, comment, submitted_at'],
    ],
];