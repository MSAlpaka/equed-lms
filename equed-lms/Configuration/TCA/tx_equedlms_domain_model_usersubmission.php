<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_usersubmission',
        'label' => 'type',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_usersubmission.svg',
    ],
    'types' => [
        '0' => [
            'showitem' => '
                --div--;General,
                    fe_user, user_course_record, lesson, type, status,
                --div--;Content,
                    comment, feedback, files
            ',
        ],
    ],
    'columns' => [
        'fe_user' => [
            'label' => 'User',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'fe_users',
                'renderType' => 'selectSingle',
                'minitems' => 1,
                'maxitems' => 1,
            ],
        ],
        'user_course_record' => [
            'label' => 'User Course Record',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_equedlms_domain_model_usercourserecord',
                'renderType' => 'selectSingle',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'lesson' => [
            'label' => 'Lesson',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_equedlms_domain_model_lesson',
                'renderType' => 'selectSingle',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'type' => [
            'label' => 'Submission Type',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['Theory', 'theory'],
                    ['Practical', 'practical'],
                    ['Case Study', 'case'],
                    ['Upload Only', 'upload'],
                ],
                'renderType' => 'selectSingle',
                'default' => 'upload',
            ],
        ],
        'status' => [
            'label' => 'Submission Status',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['Submitted', 'submitted'],
                    ['In Review', 'in_review'],
                    ['Accepted', 'accepted'],
                    ['Rejected', 'rejected'],
                ],
                'renderType' => 'selectSingle',
                'default' => 'submitted',
            ],
        ],
        'comment' => [
            'label' => 'Comment from User',
            'config' => [
                'type' => 'text',
                'rows' => 3,
            ],
        ],
        'feedback' => [
            'label' => 'Feedback from Instructor',
            'config' => [
                'type' => 'text',
                'rows' => 3,
            ],
        ],
        'files' => [
            'label' => 'Files',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'sys_file_reference',
                'foreign_field' => 'uid_foreign',
                'foreign_table_field' => 'tablenames',
                'foreign_match_fields' => [
                    'fieldname' => 'files',
                ],
                'appearance' => [
                    'useSortable' => true,
                    'collapseAll' => true,
                    'showSynchronizationLink' => true,
                ],
            ],
        ],
    ],
];