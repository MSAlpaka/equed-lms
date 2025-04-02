<?php

return [
    'equedlms' => [
        'parent' => 'web',
        'position' => [],
        'access' => 'admin',
        'iconIdentifier' => 'module-equedlms',
        'labels' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_mod.xlf',
        'routes' => [
            '_default' => [
                'target' => \Equed\EquedLms\Controller\BackendController::class . '::listAction',
            ],
            'course_list' => [
                'target' => \Equed\EquedLms\Controller\BackendController::class . '::listAction',
            ],
            'course_show' => [
                'target' => \Equed\EquedLms\Controller\BackendController::class . '::showAction',
            ],
            'course_new' => [
                'target' => \Equed\EquedLms\Controller\BackendController::class . '::newAction',
            ],
            'course_create' => [
                'target' => \Equed\EquedLms\Controller\BackendController::class . '::createAction',
            ],
            'course_edit' => [
                'target' => \Equed\EquedLms\Controller\BackendController::class . '::editAction',
            ],
            'course_update' => [
                'target' => \Equed\EquedLms\Controller\BackendController::class . '::updateAction',
            ],
            'course_delete' => [
                'target' => \Equed\EquedLms\Controller\BackendController::class . '::deleteAction',
            ],
        ],
    ],

    // Neues Modul für das ServiceCenter
    'web_ServiceCenter' => [
        'parent' => 'web',
        'position' => ['after' => 'web_info'],
        'access' => 'user,group',
        'iconIdentifier' => 'module-equed-servicecenter',
        'labels' => 'LLL:EXT:equed_lms/Resources/Private/Language/locallang_servicecenter.xlf',
        'routes' => [
            '_default' => [
                'target' => \Equed\EquedLms\Controller\ServiceCenterController::class . '::dashboardAction',
            ],
        ],
    ],
];