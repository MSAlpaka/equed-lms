<?php

return [
    'ctrl' => [
        'title' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_db.xlf:tx_equedlms_domain_model_courseinstance',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'sortby' => 'start_date',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_courseinstance.svg',
    ],
    'types' => [
        '0' => [
            'showitem' => '
                --div--;General,
                    title, program, center, start_date, end_date, is_public, max_participants, auto_assign_instructor,
                --div--;Relations,
                    instructors, user_course_records
            ',
        ],
    ],
    'columns' => [
        'title' => [
            'label' => 'Title',
            'config' => ['type' => 'input', 'required' => true],
        ],
        'program' => [
            'label' => 'Course Program',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_equedlms_domain_model_courseprogram',
                'renderType' => 'selectSingle',
                'minitems' => 1,
                'maxitems' => 1,
            ],
        ],
        'center' => [
            'label' => 'Center',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_equedlms_domain_model_center',
                'renderType' => 'selectSingle',
            ],
        ],
        'start_date' => [
            'label' => 'Start Date',
            'config' => ['type' => 'datetime'],
        ],
        'end_date' => [
            'label' => 'End Date',
            'config' => ['type' => 'datetime'],
        ],
        'is_public' => [
            'label' => 'Public Course',
            'config' => ['type' => 'check'],
        ],
        'max_participants' => [
            'label' => 'Max Participants',
            'config' => ['type' => 'number'],
        ],
        'auto_assign_instructor' => [
            'label' => 'Auto Assign Instructor',
            'config' => ['type' => 'check'],
        ],
        'instructors' => [
            'label' => 'Instructors',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'fe_users',
                'MM' => '',
                'size' => 5,
                'autoSizeMax' => 20,
                'maxitems' => 9999,
            ],
        ],
        'user_course_records' => [
            'label' => 'User Course Records',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_equedlms_domain_model_usercourserecord',
                'foreign_field' => 'course_instance',
                'maxitems' => 9999,
            ],
        ],
    ],
];