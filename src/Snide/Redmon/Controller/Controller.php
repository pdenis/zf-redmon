<?php

namespace Snide\Redmon\Controller;

use Zend\Mvc\Controller\AbstractActionController;

use Zend\View\Model\ViewModel;
use Zend\Session\Container;

/**
 * Class Controller
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class Controller extends AbstractActionController
{
	protected function createView($path, $params)
	{
        $view = new ViewModel($params);
        $view->setTemplate('/snide/redmon/'.$path);

        return $view;
	}

	/**
     * Get instance manager
     * 
     * @return mixed
     */
    protected function getManager()
    {
        return $this->getServiceLocator()->get('snide_redmon.manager.instance');
    }
    
    /**
     * Get the current instance if exists
     * 
     * @return mixed
     */
    protected function getCurrentInstance()
    {
        $instance = $this->getSession()->instance;
        
        if($instance) {
            // Update of instance to have last logs created
            $instance = $this->getManager()->find($instance->getId());
        }
        return $instance;
    }
    
    /**
     * Get the current session 
     * 
     * @return \Zend\Session\Container
     */
    protected function getSession()
    {
        return new Container('snide_redmon');
    }
    /**
     * Get instance worker initialized with current instance
     * 
     * @return boolean
     */
    protected function getWorker()
    {
        $instance = $this->getCurrentInstance();
        if($instance) {
            // Initialized with the current instance
            
            $worker = $this->getServiceLocator()
                ->get('snide_redmon.worker.instance')
                ->setInstance($instance);
            // We return worker only if the server is up
            if($worker->ping()) {
                return $worker;
            }
            // If we can't ping the server, current instance is removed from session
            $this->getSession()->instance = null;
            
            return false;
        }
        return false;
    }

    protected function setFlashMessage($ns, $message)
    {
        $this->flashMessenger()
            ->setNamespace($ns)
            ->addMessage($message);
    }
}