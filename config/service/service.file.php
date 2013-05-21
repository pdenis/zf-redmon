<?php

return array(
	'invokables' => array(
		'snide_redmon.entity.instance' => 'Ringo\PhpRedmon\Model\Instance',
		'snide_redmon.entity.log'      => 'Ringo\PhpRedmon\Model\Log',
	),
	'factories' => array(
		'snide_redmon.repository.instance' => function($sm) {
			$config = $sm->get('Config');

			if(isset($config['snide_redmon']['repository']['dir'])) {
				$dir = $config['snide_redmon']['repository']['dir'];
			}else {
				throw new \Exception('You must provide a repository folder for file storage');
			}
			$adapter = new Gaufrette\Adapter\Local($dir);
			$filesystem = new Gaufrette\Filesystem($adapter);
			
			$class = '';
			$config = $sm->get('Config');

			if(isset($config['snide_redmon.entity.instance.class'])) {
				$class = $config['snide_redmon.entity.instance.class'];
			}
			return new \Ringo\PhpRedmon\File\Repository\InstanceRepository($filesystem, $class);
		}
    ),
);