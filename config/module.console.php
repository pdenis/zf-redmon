<?php

return array(
    'router' => array(
        'routes' => array(
            'snide_redmon_command_log' => array(
                'options' => array(
                    'route' => 'snide-redmon log', 
                    'defaults' => array(
                        'controller' => 'Snide\Redmon\Controller\Command',
                        'action' => 'execute'
                    ),
                ),
            ),
        )
    )	
);