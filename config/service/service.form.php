<?php

return array(
	'invokables' => array(
		'snide_redmon.input_filter.instance' => 'Snide\Redmon\InputFilter\InstanceFilter',
	),
	'factories' => array(
		'snide_redmon.form.instance' => function($sm) {
			$form = new \Snide\Redmon\Form\InstanceForm('snide_redmon_instance');
			$if = $sm->get('snide_redmon.input_filter.instance');
			$form->setInputFilter($if);

			return $form;
		}
    ),
);