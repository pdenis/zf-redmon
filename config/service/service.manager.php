<?php

return array(
	'factories' => array(
        'snide_redmon.manager.instance' => function($sm) {
			$instanceRepository = $sm->get('snide_redmon.repository.instance');
			$class = '';
			$config = $sm->get('Config');
			if(isset($config['snide_redmon.entity.instance.class'])) {
				$class = $config['snide_redmon.entity.instance.class'];
			}

			return new \Ringo\PhpRedmon\Manager\InstanceManager($instanceRepository, $class);
        },
        'snide_redmon.manager.log' => function($sm) {
			$class = '';
			$config = $sm->get('Config');
			if(isset($config['snide_redmon.entity.log.class'])) {
				$class = $config['snide_redmon.entity.log.class'];
			}
			return new \Ringo\PhpRedmon\Manager\LogManager($class);
        }
    ),
);