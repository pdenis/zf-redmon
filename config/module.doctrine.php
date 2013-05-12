<?php

return array(
	'driver' => array(
		'snide_redmon_entities' => array(
			'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
			'cache' => 'array',
			'paths' => array(__DIR__ . '/../src/Snide/Redmon/Entity')
		),
		'orm_default' => array(
			'drivers' => array(
				'Snide\Redmon\Entity' => 'snide_redmon_entities'
			)
		)
	)
);