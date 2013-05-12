<?php

namespace Snide\Redmon\Controller;

use Snide\Redmon\Controller\Controller;

/**
 * Class DashController
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class DashController extends Controller
{
	public function indexAction()
	{
		$instance = $this->getCurrentInstance();
        if($instance) {
           
            $worker = $this->getWorker();
            // Worker can be undefined if server went away
            // For the current instance or if there is no instance selected
            if($worker) {
                return $this->createView('dash/index', array(
                    'instance' => $worker->getInstance(),
                    'infos'    => $worker->getInfos(),
                    'slowLogs'  => $worker->getSlowLogs(),
                    'keyspace'  => $worker->getKeyspace()
                ));
            }
        }
        return $this->redirect()->toRoute('snide_redmon_instance');
	}

	public function clientAction()
	{
		$worker = $this->getWorker();
        // Worker can be undefined if server went away
        // For the current instance or if we have no instance selected
        if($worker) {
			return $this->createView('dash/client', array(
				'instance' => $worker->getInstance(),
				'clients'=> $worker->getClients()
			));
        }

        return $this->redirect()->toRoute('snide_redmon_instance');
	}

	/**
     * Render configuration list for the current instance
     */
    public function configurationAction()
    {
        $worker = $this->getWorker();
        // Worker can be undefined if server went away
        // For the current instance or if we have no instance selected
        if($worker) {
           return $this->createView('dash/configuration', array(
				'instance' => $worker->getInstance(),
				'configs'  => $worker->getConfiguration()
			));
        }
        
        return $this->redirect()->toRoute('snide_redmon_instance');
    }
}