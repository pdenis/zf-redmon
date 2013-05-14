<?php

return array(
	'driver' => array(
		'snide_redmon_entities' => array(
			'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
			'cache' => 'array',
			'paths' => array(__DIR__ . '/../src/SnideRedmon/Entity')
		),
		'orm_default' => array(
			'drivers' => array(
				'SnideRedmon\Entity' => 'snide_redmon_entities'
			)
		)
	)
);