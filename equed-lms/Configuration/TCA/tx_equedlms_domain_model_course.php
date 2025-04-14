<?php

return [
    'ctrl' => [
        'title' => 'Course',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'hideTable' => false,
        'iconfile' => 'EXT:equed_lms/Resources/Public/Icons/tx_equedlms_domain_model_course.svg',
    ],
    'types' => [
        '0' => [
            'showitem' => '
                --div--;General,
                    title, description, category, finishGoal, image, is_active,
                --div--;Structure,
                    lessons, instructor, center,
                --div--;Logic,
                    prerequisites, recommended_specialties, grants_certificate, requires_external_validation,
                --div--;Access,
                    sorting
            ',
        ],
    ],
    'columns' => [
        'title' => [
            'label' => 'Title',
            'config' => ['type' => 'input', 'required' => true],
        ],
        'description' => [
            'label' => 'Description',
            'config' => ['type' => 'text', 'rows' => 6],
        ],
        'category' => [
            'label' => 'Category',
            'config' => ['type' => 'input'],
        ],
        'finishGoal' => [
            'label' => 'Finish Goal',
            'config' => ['type' => 'input'],
        ],
        'prerequisites' => [
            'label' => 'Prerequisites (JSON / Shortnames)',
            'config' => ['type' => 'text', 'rows' => 4],
        ],
        'image' => [
            'label' => 'Image',
            'config' => [
                'type' => 'file',
                'maxitems' => 1,
                'appearance' => ['createNewRelationLinkTitle' => 'Add File'],
            ],
        ],
        'is_active' => [
            'label' => 'Active',
            'config' => ['type' => 'check'],
        ],
        'lessons' => [
            'label' => 'Lessons',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_equedlms_domain_model_lesson',
                'foreign_field' => 'course',
                'maxitems' => 9999,
                'appearance' => ['collapseAll' => 1],
            ],
        ],
        'instructor' => [
            'label' => 'Instructor',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'fe_users',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'center' => [
            'label' => 'Center',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'foreign_table' => 'tx_equedlms_domain_model_center',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'recommended_specialties' => [
            'label' => 'Recommended Specialties',
            'config' => ['type' => 'text', 'rows' => 3],
        ],
        'grants_certificate' => [
            'label' => 'Grants Certificate',
            'config' => ['type' => 'check'],
        ],
        'requires_external_validation' => [
            'label' => 'Requires External Validation',
            'config' => ['type' => 'check'],
        ],
        'sorting' => [
            'label' => 'Sorting',
            'config' => ['type' => 'number'],
        ],
    ],
];