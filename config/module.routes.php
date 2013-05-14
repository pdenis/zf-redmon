<?php

return array(
    'routes' => array(
       'snide_redmon' => array(
            'type'    => 'literal',
            'options' => array(
                'route'    => '/',
                'defaults' => array(
                    'controller' => 'SnideRedmon\Controller\Dash',
                    'action'     => 'index'
                ),
            ),
            'may_terminate' => true,
            'child_routes' => array(
                'client' => array(
                    'type'    => 'literal',
                    'options' => array(
                        'route'    => 'clients',
                        'defaults' => array(
                            'action' => 'client'
                        )
                    )
                ),
                'configuration' => array(
                    'type'    => 'literal',
                    'options' => array(
                        'route'    => 'configuration',
                        'defaults' => array(
                            'action' => 'configuration'
                        )
                    )
                )
            )
        ),
        'snide_redmon_instance' => array(
            'type'    => 'literal',
            'options' => array(
                'route'    => '/instances',
                'defaults' => array(
                    'controller' => 'SnideRedmon\Controller\Instance',
                    'action'     => 'index'
                ),
            ),
            'may_terminate' => true,
            'child_routes' => array(
                'edit' => array(
                    'type'    => 'segment',
                    'options' => array(
                        'route'       => '/edit/[:id]',
                        'constraints' => array(
                            'id' => '[0-9]+'
                        ),
                        'defaults' => array(
                            'controller' => 'SnideRedmon\Controller\Instance',
                            'action' => 'update'
                        )
                    )
                ),
                'select' => array(
                    'type'    => 'segment',
                    'options' => array(
                        'route'       => '/select/[:id]',
                        'constraints' => array(
                            'id' => '[0-9]+'
                        ),
                        'defaults' => array(
                            'controller' => 'SnideRedmon\Controller\Instance',
                            'action' => 'select'
                        )
                    )
                ),
                'delete' => array(
                    'type'    => 'segment',
                    'options' => array(
                        'route'       => '/delete/[:id]',
                        'constraints' => array(
                            'id' => '[0-9]+'
                        ),
                        'defaults'    => array(
                            'controller' => 'SnideRedmon\Controller\Instance',
                            'action' => 'delete'
                        )
                    )
                ),
                'new' => array(
                    'type'    => 'literal',
                    'options' => array(
                        'route'    => '/new',
                        'defaults' => array(
                            'action' => 'create'
                        )
                    )
                ),
                'update' => array(
                    'type'    => 'method',
                    'options' => array(
                        'route'    => '/update',
                        'verb'     => 'post',
                        'defaults' => array(
                            'controller' => 'SnideRedmon\Controller\Instance',
                            'action' => 'update'
                        )
                    )
                ),
                'create' => array(
                    'type'    => 'literal',
                    'options' => array(
                        'route'    => '/create',
                        'verb' => 'post',
                        'defaults' => array(
                            'controller' => 'SnideRedmon\Controller\Instance',
                            'action' => 'create'
                        )
                    )
                ),
            )
        )
    )
);