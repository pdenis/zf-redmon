<?php

return array(
	'factories' => array(
        'snide_redmon.logger.instance' => function($sm) {
			$instanceManager = $sm->get('snide_redmon.manager.instance');
			$worker  = $sm->get('snide_redmon.worker.instance');
			$logManager = $sm->get('snide_redmon.manager.log');
			$nbDays = 30; // Default value
			if(isset($config['snide_redmon.logger.nb_days'])) {
				$nbDays = $config['snide_redmon.logger.nb_days'];
			}
			return new \Snide\Redmon\Logger\InstanceLogger($instanceManager, $logManager, $worker, $nbDays);
        }
    ),
);