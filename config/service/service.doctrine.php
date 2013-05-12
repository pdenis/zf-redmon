<?php

return array(
	'invokables' => array(
		'snide_redmon.entity.instance' => 'Snide\Redmon\Entity\Instance',
		'snide_redmon.entity.log'      => 'Snide\Redmon\Entity\Log',
		'snide_redmon.entity.database' => 'Snide\Redmon\Entity\Database',
	),
	'factories' => array(
        'snide_redmon.repository.instance' => function($sm) {
			$em = $sm->get('Doctrine\ORM\EntityManager');
			$config = $sm->get('Config');
			$class = '';
			if(isset($config['snide_redmon.entity.instance.class'])) {
				$class = $config['snide_redmon.entity.instance.class'];
			}

			return $em->getRepository($class);
		},
		'snide_redmon.repository.log' => function($sm) {
			$em = $sm->get('Doctrine\ORM\EntityManager');
			$config = $sm->get('Config');
			$class = '';
			if(isset($config['snide_redmon.entity.log.class'])) {
				$class = $config['snide_redmon.entity.log.class'];
			}

			return $em->getRepository($class);
		}
    ),
);