<?php

return array(
    'router'       => include __DIR__.'/module.routes.php',
    'view_manager' => include __DIR__.'/module.view.php',
    'controllers'  => include __DIR__.'/module.controllers.php',
    'console'      => include __DIR__.'/module.console.php', 
    'doctrine'     => include __DIR__.'/module.doctrine.php',
);