<?php

namespace Snide\Redmon\Controller;

use Snide\Redmon\Controller\Controller;

/**
 * Class AdminController
 *
 * @author Pascal DENIS <pascal.denis.75@gmail.com>
 */
class AdminController extends Controller
{
	public function indexAction()
	{
		return $this->createView('admin/index', array());
	}

	public function flushAllAction()
    {
        try {
            $this->getWorker()->execute('flushAll');
            
            $this->setFlashMessage('success', 'Flush ALL executed successfully');
        }catch(\Exception $e) {
            $this->setFlashMessage('error', 'We have encountered an error : '.$e->getMessage());
        }
        
        return $this->redirect()->toRoute('snide_redmon_instance');
    }
    
    /**
     * Call flush DB command for the current instance and the current database
     * 
     * @param int $id Database index
     */
    public function flushDbAction($id)
    {
        try {
            $worker = $this->getWorker()->flushDB($id);
            
            $this->get('session')->setFlash('success', 'Flush DB on '.$worker->getInstance()->getDatabase($id)->getName().' executed successfully');
        }catch(\Exception $e) {
            $this->get('session')->setFlash('success', 'Une erreur s\'est produite : '.$e->getMessage());
        }
        
        return $this->redirect()->toRoute('snide_redmon_instance');
    }
}