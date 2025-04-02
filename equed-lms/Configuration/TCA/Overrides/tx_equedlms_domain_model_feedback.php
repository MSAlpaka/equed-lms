<?php
return [
    'ctrl' => [
        'title' => 'Feedback',
        'label' => 'user',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'user,course,instructorRating,locationRating',
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/feedback.svg',
    ],
    'interface' => [
        'showRecordFieldList' => 'user,course,instructorRating,locationRating,sendToInstructor,additionalRequests',
    ],
    'types' => [
        '1' => ['showitem' => 'user, course, standards, instructorRating, locationRating, sendToInstructor, futureCourses, additionalRequests'],
    ],
    'columns' => [
        'user' => [
            'label' => 'User',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'fe_users',
                'maxitems' => 1,
                'minitems' => 1,
            ],
        ],
        'course' => [
            'label' => 'Course',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_equedlms_domain_model_course',
                'maxitems' => 1,
                'minitems' => 1,
            ],
        ],
        'instructorRating' => [
            'label' => 'Instructor Rating',
            'config' => [
                'type' => 'select',
                'items' => [
                    [1, 1],
                    [2, 2],
                    [3, 3],
                    [4, 4],
                    [5, 5],
                ],
            ],
        ],
        'locationRating' => [
            'label' => 'Location Rating',
            'config' => [
                'type' => 'select',
                'items' => [
                    [1, 1],
                    [2, 2],
                    [3, 3],
                    [4, 4],
                    [5, 5],
                ],
            ],
        ],
        'sendToInstructor' => [
            'label' => 'Send to Instructor',
            'config' => [
                'type' => 'check',
            ],
        ],
        'additionalRequests' => [
            'label' => 'Additional Requests',
            'config' => [
                'type' => 'text',
                'cols' => 30,
                'rows' => 5,
            ],
        ],
        'futureCourses' => [
            'label' => 'Future Courses',
            'config' => [
                'type' => 'text',
                'cols' => 30,
                'rows' => 5,
            ],
        ],
        'standards' => [
            'label' => 'Standards Answers',
            'config' => [
                'type' => 'text',
                'cols' => 30,
                'rows' => 5,
            ],
        ],
    ],
];