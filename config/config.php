<?php
return [
    'router' => [
        'routes' => [
            'add-ads' => \Laminas\Router\Http\Literal::factory([
                'route' => '/ads',
                'defaults' => [
                    'controller' => \Kliker02\VcruTask\Controllers\AdsController::class,
                    'action'     => 'add',
                ]
            ]),
            'edit-ads' => \Laminas\Router\Http\Segment::factory([
                'route' => '/ads/:id',
                'constraints' => [
                    'id' => '[0-9]+'
                ],
                'defaults' => [
                    'controller' => \Kliker02\VcruTask\Controllers\AdsController::class,
                    'action'     => 'edit',
                ]
            ]),
            'relevant-ads' => \Laminas\Router\Http\Literal::factory([
                'route' => '/ads/relevant',
                'defaults' => [
                    'controller' => \Kliker02\VcruTask\Controllers\AdsController::class,
                    'action'     => 'relevant',
                ]
            ])
        ],
    ],
    'database' => [
        'driver' => 'Mysqli',
        'database' => 'ads_project',
        'username' => 'root',
        'password' => '',
    ]
];
