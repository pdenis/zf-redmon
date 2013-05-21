<?php

return array(
	'doctrine' => array(
		'driver' => array(
			'snide_redmon_entities' => array(
				'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				'paths' => array(__DIR__ . '/../src/SnideRedmon/Entity')
			),
			'orm_default' => array(
				'drivers' => array(
					'SnideRedmon\Entity' => 'snide_redmon_entities',
					'Ringo\PhpRedmon\Entity' => 'snide_redmon_entities'
				)
			)
		)
	),
	'snide_redmon.entity.instance.class' => 'SnideRedmon\Entity\Instance',
    'snide_redmon.entity.log.class'      => 'SnideRedmon\Entity\Log',
);